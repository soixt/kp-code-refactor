<?php

namespace App\Infrastructure\Console;

use App\Infrastructure\Console\CommandInterface;

class AbstractCommand implements CommandInterface {
    protected string $name;

    /**
     * Handle command
     * 
     * @param mixed ...$args Additional arguments.
     * @return void
     */
    public function handle(...$args): void {
        
    }

    public function getName(): string {
        return $this->name;
    }
}