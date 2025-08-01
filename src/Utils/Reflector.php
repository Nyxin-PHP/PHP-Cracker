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

class Reflector
{
    /**
     * Updates the Configuration.php file based on POST request data.
     * Uses reflection to dynamically assign new values to configuration properties.
     */
    public function updateConfig() {
        // Ensure the request method is POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $configFile = __DIR__ . '/../Config/Configuration.php';

            // Check if the configuration file exists
            if (!file_exists($configFile)) {
                die("Configuration file not found at: " . $configFile);
            }

            // 1. Load the Configuration class to access current values
            require_once $configFile;

            // 2. Instantiate the Configuration class (to reflect current values)
            $config = new \App\Config\Configuration();

            // 3. Use reflection to loop through class properties and update them from POST
            $reflectionClass = new \ReflectionClass(\App\Config\Configuration::class);
            $props = $reflectionClass->getProperties();

            foreach ($props as $prop) {
                $name = $prop->getName();
                $type = $prop->getType() ? $prop->getType()->getName() : null;

                // Skip if the type is undefined or the POST value is not set
                if (!$type || !isset($_POST[$name])) {
                    continue;
                }

                $value = $_POST[$name];

                // Cast the value to the appropriate type
                switch ($type) {
                    case 'string':
                        $config->$name = (string)$value;
                        break;
                    case 'int':
                        $config->$name = (int)$value;
                        break;
                    case 'bool':
                        // Convert to boolean using filter_var
                        $config->$name = filter_var($value, FILTER_VALIDATE_BOOLEAN);
                        break;
                    default:
                        // Handle other types if needed
                        break;
                }
            }

            // 4. Build the updated content for the configuration file
            $newConfigContent = "<?php\n\n";
            $newConfigContent .= "namespace App\\Config;\n\n";
            $newConfigContent .= "class Configuration\n{\n";

            foreach ($props as $prop) {
                $name = $prop->getName();
                $type = $prop->getType() ? $prop->getType()->getName() : null;
                $currentValue = $config->$name;

                $line = "    public ";

                // Include the type declaration if available
                if ($type) {
                    $line .= $type . " ";
                }

                $line .= "$" . $name . " = ";

                // Format the value for writing into the file
                switch ($type) {
                    case 'string':
                        $line .= "'" . str_replace("'", "\\'", $currentValue) . "'";
                        break;
                    case 'int':
                        $line .= (int)$currentValue;
                        break;
                    case 'bool':
                        $line .= $currentValue ? 'true' : 'false';
                        break;
                    default:
                        // Use var_export for complex types
                        $line .= var_export($currentValue, true);
                        break;
                }

                $line .= ";\n";
                $newConfigContent .= $line;
            }

            $newConfigContent .= "}\n";

            // 5. Write the updated content back to the configuration file
            file_put_contents($configFile, $newConfigContent);

            //  confirm success
             echo "Updated successfully.";
        } else {
            // echo "POST method is required for this operation.";
        }
    }
}
