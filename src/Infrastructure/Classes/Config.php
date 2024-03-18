<?php

namespace App\Infrastructure\Classes;

/**
 * Config class.
 *
 * This class is responsible for loading and retrieving configuration settings from configuration files.
 */
class Config {
    /** @var array An associative array to store configuration settings. */
    protected array $configurations = [];

    /**
     * Constructor.
     *
     * Loads configuration settings from configuration files.
     */
    public function __construct() {
        // Get list of configuration files
        $configFiles = glob(__DIR__ . '/../../config/*.php');
        
        foreach ($configFiles as $configFile) {
            // Load configuration file
            $configName = pathinfo($configFile, PATHINFO_FILENAME);
            $this->configurations[$configName] = require $configFile;
        }

        // Maybe cache config (optional)
    }

    /**
     * Get method.
     *
     * Retrieves a configuration value based on the provided key.
     *
     * @param string $key The configuration key to retrieve.
     * @return mixed|null The configuration value, or null if the key is not found.
     */
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
