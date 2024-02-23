<?php

$commands = [
    'migrate:fresh' => function () {
        // Assuming you have a class like this
        $migrationCommand = new \App\Commands\InitDatabaseCommand();
        $migrationCommand->handle();
    },
    'migrate' => function () {
        // Assuming you have a class like this
        $migrationCommand = new \App\Commands\MigrateDatabaseCommand();
        $migrationCommand->handle();
    },
    'another-command' => function () {
        // Another command handling
    },
    // ... more commands
];

// Get the command from the first argument
$commandName = $argv[1] ?? null;

// Execute the command if it exists
if (array_key_exists($commandName, $commands)) {
    $commands[$commandName]();
} else {
    echo "Unknown command: {$commandName}\n";
    echo "Available commands:\n";
    foreach (array_keys($commands) as $cmd) {
        echo " - {$cmd}\n";
    }
    exit(1);
}