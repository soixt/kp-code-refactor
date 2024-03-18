<?php

require __DIR__ . '/../vendor/autoload.php';

$console = new \App\Infrastructure\Console\Console();
$commands = $console->getRegistry();

// Get the command from the first argument
$commandName = $argv[1] ?? null;
unset($argv[1]);

// Execute the command if it exists
if (array_key_exists($commandName, $commands)) {
    $commands[$commandName]->handle($argv);
} else {
    echo "Unknown command: {$commandName}\n";
    echo "Available commands:\n";
    foreach (array_keys($commands) as $cmd) {
        echo " - {$cmd}\n";
    }
    exit(1);
}