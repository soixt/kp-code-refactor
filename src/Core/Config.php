<?php

namespace App\Core;

class Config {
    protected array $configurations = [];

    public function __construct() {
        // Get list of configuration files
        $configFiles = glob('config/*.php');
        
        foreach ($configFiles as $configFile) {
            // Load configuration file
            $configName = pathinfo($configFile, PATHINFO_FILENAME);
            $this->configurations[$configName] = require $configFile;
        }

        //Maybe cache config
    }

    public static function get(string $key) {
        $config = new self();
        $keys = explode('.', $key);
        $value = $config->configurations;

        foreach ($keys as $nestedKey) {
            if (isset($value[$nestedKey])) {
                $value = $value[$nestedKey];
            } else {
                // Check for nested keys
                if (is_array($value) && array_key_exists($nestedKey, $value)) {
                    // Recursively call self::get() for nested arrays
                    $value = self::get(implode('.', array_slice($keys, 1)));
                } else {
                    return null; // Key not found
                }
            }
        }

        return $value;
    }
}
