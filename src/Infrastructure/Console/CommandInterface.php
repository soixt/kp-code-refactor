<?php

namespace App\Infrastructure\Console;

/**
 * CommandInterface
 *
 * This interface defines the contract for command classes. Command classes are used
 * to encapsulate and execute specific tasks or operations within the application.
 */
interface CommandInterface {
    
    /**
     * Handle method.
     *
     * This method defines the contract for executing the command logic.
     *
     * @param mixed ...$args Additional arguments that may be passed to the command.
     * @return void
     */
    public function handle(...$args): void;

    public function getName(): string;
}
