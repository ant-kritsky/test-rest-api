<?php

namespace app;

class Container
{
    private array $objects = [];

    private static $_instance = null;

    public static function getInstance(): self
    {
        if (empty(self::$_instance)) {
            self::$_instance = new static();
        }

        return self::$_instance;
    }

    public function has(string $id): bool
    {
        return isset($this->objects[$id]) || class_exists($id);
    }

    public function get(string $id): mixed
    {
        return $this->objects[$id] ?? $this->prepareObject($id);
    }

    /**
     * @throws \ReflectionException
     */
    private function prepareObject(string $class): object
    {
        $classReflector = new \ReflectionClass($class);
        $constructReflector = $classReflector->getConstructor();

        if (empty($constructReflector)) {
            return $this->objects[$class] = new $class;
        }

        $constructArguments = $constructReflector->getParameters();

        if (empty($constructArguments)) {
            return $this->objects[$class] = new $class;
        }

        $args = [];

        foreach ($constructArguments as $argument) {
            $argumentType = $argument->getType()->getName();
            $args[$argument->getName()] = $this->get($argumentType);
        }

        return $this->objects[$class] = new $class(...$args);
    }
}