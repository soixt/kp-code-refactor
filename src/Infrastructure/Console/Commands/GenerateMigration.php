<?php

namespace App\Infrastructure\Console\Commands;
use App\Infrastructure\Console\AbstractCommand;
use App\Infrastructure\Classes\Config;

class GenerateMigration extends AbstractCommand {
    protected string $name = 'make:migration';
    /**
     * Handle command
     * 
     * @param string ...$args Additional arguments.
     * @return void
     */
    public function handle(...$args): void {
        var_dump(Config::get('app.root'));
        // Define the path to your stub file
        $stubPath = Config::get('app.root') . '/src/Infrastructure/Database/stubs/migration.stub';

        // Define where your migrations should be stored
        $migrationsDirectory = Config::get('app.migrations_path');

        // Migration name
        $name = $args[1] ?? 'UndefinedName';

        // Read the contents of the stub file
        $stubContents = file_get_contents($stubPath);

        if ($stubContents === false) {
            throw new \Exception('Error with migrations stub.');
        }

        // Generate a unique name for the new migration file
        // Example: 2024_03_18_123456_create_new_table.php
        $timestamp = date('Y_m_d_His_');
        $filename = $timestamp . $name . '.php';

        // Create the full path for the new migration file
        $newFilePath = $migrationsDirectory . '/' . $filename;

        // Write the contents to the new migration file
        $result = file_put_contents($newFilePath, $stubContents);

        if ($result === false) {
            throw new \Exception("Error writing new migration file.\n");
        }

        echo "Migration generated: " . $filename . "\n";
    }
}