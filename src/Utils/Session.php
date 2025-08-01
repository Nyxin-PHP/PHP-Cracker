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

class Session
{
  /**
  * Indicates whether the session has been started.
  */
  protected static bool $started = false;

  /**
  * Start the session if it hasn't been started already.
  *
  * Also sets a custom session lifetime (24 hours).
  */
  public static function start(): void
  {
    if (!self::$started) {
      // Set session cookie lifetime to 24 hours (in seconds)
      $lifetime = 60 * 60 * 24; // 86400 seconds

      // Configure session cookie parameters before session_start()
      session_set_cookie_params([
        'lifetime' => $lifetime,
        'path' => '/',
        'secure' => isset($_SERVER['HTTPS']),
        'httponly' => true,
        'samesite' => 'Lax'
      ]);

      // Set PHP session lifetime in memory and on disk
      ini_set('session.gc_maxlifetime', (string) $lifetime);

      session_start();
      self::$started = true;
    }
  }

  /**
  * Store a key-value pair in the session.
  */
  public static function set(string $key, mixed $value): void
  {
    self::start();
    $_SESSION[$key] = $value;
  }

  /**
  * Retrieve a value from the session, or return the default if not set.
  */
  public static function get(string $key, mixed $default = null): mixed
  {
    self::start();
    return $_SESSION[$key] ?? $default;
  }

  /**
  * Check if a given key exists in the session.
  */
  public static function has(string $key): bool
  {
    self::start();
    return isset($_SESSION[$key]);
  }

  /**
  * Remove a key-value pair from the session.
  */
  public static function remove(string $key): void
  {
    self::start();
    unset($_SESSION[$key]);
  }

  /**
  * Destroy the current session and clear all data.
  */
  public static function destroy(): void
  {
    if (self::$started) {
      session_destroy();
      self::$started = false;
    }
  }
}