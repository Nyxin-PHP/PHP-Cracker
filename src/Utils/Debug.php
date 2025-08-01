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

namespace App\Utils;

/**
* Debug class for logging messages and handling PHP errors and exceptions.
*/

class Debug
{

  // Directory path where log files will be saved.
  protected static string $LogDir = __DIR__ . '/../../cache/';

  // Ensure the log directory exists. Create it if it doesn't.
  protected static function ensureLogDir(): void
  {
    if (!is_dir(self::$LogDir)) {
      mkdir(self::$LogDir, 0777, true);
    }
  }

  // Generate the full path for a log file based on the log level.
  protected static function LogPath(string $level): string
  {
    $filename = strtolower($level) . '.log';
    return self::$LogDir . $filename;
  }

  // Write a message to the appropriate log file.
  public static function write(string $message, string $level = 'INFO'): void
  {
    self::ensureLogDir();

    $timestamp = date('Y-m-d H:i:s');
    $formatted = "[$timestamp][$level] $message\n";
    $file = self::LogPath($level);

    file_put_contents($file, $formatted, FILE_APPEND);
  }

  // Convenience logging methods for different levels
  public static function debug(string $message): void
  {
    self::write($message, 'DEBUG');
  }

  public static function info(string $message): void
  {
    self::write($message, 'INFO');
  }

  public static function errors(string $message): void
  {
    self::write($message, 'ERRORS');
  }

  // Handle exceptions.
  public static function handleException(\Throwable $e): void
  {
    $msg = sprintf(
      "%s in %s:%d\nMessage: %s",
      get_class($e),
      $e->getFile(),
      $e->getLine(),
      $e->getMessage()
    );

    self::errors("[UNCAUGHT EXCEPTION] $msg");

    echo "Internal error occurred.\n\n";

    exit(1);
  }

  // Handle PHP errors.
  public static function handleError(int $errno, string $errstr, string $errfile, int $errline): bool
  {
    $levels = [
      E_ERROR => 'ERROR',
      E_WARNING => 'WARNING',
      E_PARSE => 'PARSE',
      E_NOTICE => 'NOTICE',
      E_CORE_ERROR => 'CORE_ERROR',
      E_CORE_WARNING => 'CORE_WARNING',
      E_COMPILE_ERROR => 'COMPILE_ERROR',
      E_COMPILE_WARNING => 'COMPILE_WARNING',
      E_USER_ERROR => 'USER_ERROR',
      E_USER_WARNING => 'USER_WARNING',
      E_USER_NOTICE => 'USER_NOTICE',
      E_STRICT => 'STRICT',
      E_RECOVERABLE_ERROR => 'RECOVERABLE_ERROR',
      E_DEPRECATED => 'DEPRECATED',
      E_USER_DEPRECATED => 'USER_DEPRECATED',
    ];

    $levelName = $levels[$errno] ?? 'UNKNOWN';

    $msg = sprintf("[%s] %s in %s:%d", $levelName, $errstr, $errfile, $errline);
    self::errors($msg);

    return true;
  }

  // Enable custom error and exception handling.
  public static function enable(): void
  {
    set_exception_handler([self::class, 'handleException']);
    set_error_handler([self::class, 'handleError']);
    ini_set('display_errors', 'Off');
    ini_set('log_errors', 'On');
    error_reporting(E_ALL);
  }
}