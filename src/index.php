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
 
define('ROOT_PATH', dirname(__DIR__));

require_once ROOT_PATH . '/vendor/autoload.php';

use App\Core\Nyxin;
use App\Config\Configuration;
use App\Utils\Debug;
use App\Utils\Reflector;

Debug::enable();

$config = new Configuration();

if (php_sapi_name() === 'cli') {
    $args = $argv;

    if (isset($args[1]) && $args[1] === 'crack') {
        $Nyxin = new Nyxin($config);
        $Nyxin->Run();
    }
} else {
  
    if (isset($_GET['crack'])) {
        $Nyxin = new Nyxin($config);
        $Nyxin->Run();
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $Reflect = new Reflector();
        $Reflect->updateConfig();
    }
}