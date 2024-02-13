<?php

namespace App\Core\Interfaces;

interface CommandInterface {
    public static function handle (...$args) : void;
}