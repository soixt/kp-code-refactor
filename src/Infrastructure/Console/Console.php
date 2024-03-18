<?php

namespace App\Infrastructure\Console;

use App\Infrastructure\Classes\Config;
use DirectoryIterator;
use ReflectionClass;

class Console {
    protected array $registry = [];

    public function __construct() {
        $this->getInfrastructureCommands();
        // $this->getDomainCommands();
    }

    protected function getInfrastructureCommands () {
        $commandNamespace = 'App\\Infrastructure\\Console\\Commands';
        $commandPath = Config::get('app.root') . 'src/Infrastructure/Console/Commands';

        foreach (new DirectoryIterator($commandPath) as $file) {
            if ($file->isDot() || !$file->isFile() || $file->getExtension() !== 'php') {
                continue;
            }
        
            $className = $commandNamespace . '\\' . $file->getBasename('.php');
            if (!class_exists($className)) {
                continue;
            }
        
            $reflectionClass = new ReflectionClass($className);
            if ($reflectionClass->implementsInterface(CommandInterface::class) && !$reflectionClass->isAbstract()) {
                $newInstance = $reflectionClass->newInstance();
                $this->registry[$newInstance->getName()] = $newInstance;
            }
        }
    }

    protected function getDomainCommands () {
        $commandNamespace = 'App\\Domain\\Commands';
        $commandPath = Config::get('app.root') . 'src/Domain/Commands';

        foreach (new DirectoryIterator($commandPath) as $file) {
            if ($file->isDot() || !$file->isFile() || $file->getExtension() !== 'php') {
                continue;
            }
        
            $className = $commandNamespace . '\\' . $file->getBasename('.php');
            if (!class_exists($className)) {
                continue;
            }
        
            $reflectionClass = new ReflectionClass($className);
            if ($reflectionClass->implementsInterface(CommandInterface::class) && !$reflectionClass->isAbstract()) {
                $newInstance = $reflectionClass->newInstance();
                $this->registry[$newInstance->getName()] = $newInstance;
            }
        }
    }

    public function getRegistry ():array {
        return $this->registry;
    }
}