<?php

/**
* @package    Nyxin Projects - PHP Password Brute Force / Cracking Tool
* @copyright  (C) 2008 - 2025 [Nyxin PHP Password Cracker]
* @license    GNU Affero General Public License v3.0 or later; see LICENSE.txt
*
* This file is part of the Nyxin PHP Password Cracker.
*
* Nyxin PHP Password Cracker is free software: you can redistribute it and/or modify
* it under the terms of the GNU Affero General Public License as published by
* the Free Software Foundation, either version 3 of the License, or (at your option)
* any later version.
*/

namespace App\Core;

use App\Config\Configuration;
use App\Utils\Session;

class Nyxin
{

  private Configuration $config;

  public function __construct(Configuration $config) {

    $this->config = $config;

  }

  public function Run() {

    set_time_limit(0);

    if ($this->config->ignoreAbort) {
      ignore_user_abort(true);
    }

    ini_set('max_execution_time', 0);

    ini_set('memory_limit', '512M');

    ob_start();
    // or ob_start(null, 10240);
    ob_implicit_flush(true);

    header('Content-Type: text/event-stream; charset=utf-8');
    header('Cache-Control: no-cache, no-store, must-revalidate');
    header('Pragma: no-cache');
    header('Expires: 0');
    header('Connection: Keep-Alive');

    if ($this->config->Resume) {
      $this->loadHash();
    }

    if ($this->config->Formation === 'wordslist') {
      $words = $this->Lexicon();
      foreach ($words as $word) {
        $this->Multiplexer($word);
        if ($this->config->ShowPasswords) {
          echo "{$word}\n\n";

          @ob_flush();
          @flush();
        }
        if ($this->config->Pause) {
          $this->storeLastHash($word);
        }
        usleep($this->config->Delay);
      }
    } elseif ($this->config->Formation === 'matrix') {
      $passwords = $this->Matrices();
      foreach ($passwords as $password) {
        $this->Multiplexer($password);
        if ($this->config->ShowPasswords) {
          echo "$password \n\n";

          @ob_flush();
          @flush();

        }
        if ($this->config->Pause) {
          $this->storeLastHash($password);
        }
        usleep($this->config->Delay);
      }
    } else {
      echo "Unknown Method: {$this->config->Formation}";
    }
  }

  private function Remixer(): array {

    $Numbers = range(0, 9);
    $SmallLetters = range('a', 'z');
    $CapitalLetters = range('A', 'Z');
    $Symbols = [];

    return match ($this->config->Characters) {
      'Numbers' => $Numbers,
      'lowercase' => $SmallLetters,
      'uppercase' => $CapitalLetters,
      'Symbols' => $Symbols,
      'Numbers_lowercase' => array_merge($Numbers, $SmallLetters),
      'Numbers_uppercase' => array_merge($Numbers, $CapitalLetters),
      'Numbers_Symbols' => array_merge($Numbers, $Symbols),
      'lowercase_uppercase' => array_merge($SmallLetters, $CapitalLetters),
      'lowercase_Symbols' => array_merge($SmallLetters, $Symbols),
      'uppercase_Symbols' => array_merge($CapitalLetters, $Symbols),
      'Numbers_lowercase_uppercase' => array_merge($Numbers, $SmallLetters, $CapitalLetters),
      'Numbers_lowercase_Symbols' => array_merge($Numbers, $SmallLetters, $Symbols),
      'Numbers_uppercase_Symbols' => array_merge($Numbers, $CapitalLetters, $Symbols),
      'lowercase_uppercase_Symbols' => array_merge($SmallLetters, $CapitalLetters, $Symbols),
      'Numbers_lowercase_uppercase_Symbols' => array_merge($Numbers, $SmallLetters, $CapitalLetters, $Symbols),
      'Unique' => array_values(array_unique(preg_split('//u', $this->config->UniqueChars, -1, PREG_SPLIT_NO_EMPTY))),
      default => [],

      };
    }

    private function Matrices(): \Generator {

      set_time_limit(0);
      ini_set('max_execution_time', 0);
      ini_set('memory_limit', '512M');

      $chars = $this->Remixer();
      $count = count($chars);

      for ($length = $this->config->MinLen; $length <= $this->config->MaxLen; $length++) {
        $total = pow($count, $length);

        $start = is_numeric($this->config->StartPoint)
        ? (int)$this->config->StartPoint
        : $this->toIndex($this->config->StartPoint, $chars);

        for ($i = $start; $i < $total; $i++) {
          $localIndex = $i;
          $password = '';

          for ($j = 0; $j < $length; $j++) {
            $divisor = pow($count, $length - $j - 1);
            $position = (int)floor($localIndex / $divisor);
            $password .= $chars[$position];
            $localIndex %= $divisor;
          }
          if ($i % 1 === 0) {

            if (file_exists('stop.flag') && trim(file_get_contents('stop.flag')) === 'STOP') {

              echo "Application stopped by user. <br> All tasks have been canceled.<br> See 'etc/stop.flag'";
              exit();
            }
          }
          yield $password;
        }
      }
    }

    private function toIndex(string $password, array $chars): int {

      $base = count($chars);
      $index = 0;
      $length = strlen($password);

      for ($i = 0; $i < $length; $i++) {
        $char = $password[$i];
        $pos = array_search($char, $chars);
        if ($pos === false) {
          throw new \Exception("Invalid character '$char' for Start Point");
        }
        $index += $pos * pow($base, $length - $i - 1);
      }
      return $index;
    }

    private function Multiplexer(string $password): void {

      $className = 'App\\Servers\\' . $this->config->Target;
      $filePath = __DIR__ . "/../Servers/{$this->config->Target}.php";

      if (!file_exists($filePath)) {
        echo "Handler not found: {$this->config->Target}";
        return;
      }

      require_once $filePath;

      if (!class_exists($className)) {
        echo "Class not found: $className";
        return;
      }

      $handler = new $className($this->config);
      $handler->handle($password);
    }

    private function Lexicon(): array {

      $dictFile = __DIR__ . '/../../dict-attack/wordslist.txt';
      $words = [];

      if (!file_exists($dictFile)) {
        echo "file does not exist: $dictFile";
        exit();
      }

      $handle = fopen($dictFile, 'r');

      if ($handle) {
        $words = [];
        while (($line = fgets($handle)) !== false) {
          $word = trim($line);
          if (!empty($word)) {
            $words[] = $word;
          }
        }
        fclose($handle);

        if (empty($words)) {
          echo "Error: The word list file is empty.";
        }
      } else {
        echo "Error opening wordslist file.";
      }

      return $words;
    }

    private function storeLastHash(string $password): void {
      $lastHash = Session::get('last_hash');

      if ($lastHash === $password) {
        Session::remove('last_hash');
        return;
      }

      Session::set('last_hash', $password);
    }

    private function loadHash(): void {
      $lastPoint = Session::get('last_hash', '');

      if (!empty($lastPoint)) {
        $this->config->StartPoint = $lastPoint;
      } else {
        if (empty($this->config->StartPoint)) {
          $this->config->StartPoint = "";
        }
      }
    }


  } /* */