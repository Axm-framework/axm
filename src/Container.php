<?php

declare(strict_types=1);

namespace Axm;

use Closure;
use ReflectionFunction;
use ReflectionClass;
use ReflectionMethod;
use ReflectionNamedType;
use RuntimeException;

class Container
{
    /**
     * @var Container|null
     */
    private static ?Container $instance = null;

    /**
     * @var array
     */
    private array $services = [];

    /**
     * @var array
     */
    private array $sharedInstances = [];


    private function __construct()
    {
    }

    private function __clone()
    {
    }

    public function __wakeup()
    {
    }

    /**
     * @return Container
     */
    public static function getInstance(): Container
    {
        if (!self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * @inheritdoc
     */
    public function get($id)
    {
        if (array_key_exists($id, $this->sharedInstances)) {
            return $this->sharedInstances[$id];
        }

        if (!$this->has($id)) {
            throw new RuntimeException("Service not found: $id");
        }

        $service    = $this->services[$id];
        $parameters = $this->getParameters($service['closure']);

        $instance = $service['closure'](...$parameters);

        if ($service['shared']) {
            $this->sharedInstances[$id] = $instance;
        }

        return $instance;
    }


    /**
     * @inheritdoc
     */
    public function has($id): bool
    {
        return isset($this->services[$id]);
    }

    /**
     * @param string $id
     * @param \Closure $closure
     * @param bool $shared
     */
    public function set(string $id, Closure $closure, bool $shared = false)
    {
        $this->services[$id] = [
            'closure' => $closure,
            'shared'  => $shared,
        ];

        return $this;
    }

    /**
     * @param string $file
     * @param string $ext
     * @throws RuntimeException
     */
    public function load(string $file, string $ext = '.php'): void
    {
        $filePath = $file . $ext;

        if (!is_file($filePath)) {
            throw new RuntimeException("Configuration file not found: $filePath");
        }

        $config = include_once $filePath;

        foreach ($config as $id => $service) {
            if (isset($service['class'])) {
                $class  = $service['class'];
                $shared = $service['shared'] ?? false;

                $closure = function (...$args) use ($class) {
                    return (new ReflectionClass($class))->newInstanceArgs($args);
                };

                $this->set($id, $closure, $shared);
            } elseif (isset($service['closure'])) {
                $closure = $service['closure'];
                $shared  = $service['shared'] ?? false;

                $this->set($id, $closure, $shared);
            } else {
                throw new RuntimeException("Invalid service configuration for: $id");
            }
        }
    }

    /**
     * @param string $id
     */
    public function remove(string $id): void
    {
        unset($this->services[$id]);
        unset($this->sharedInstances[$id]);
    }

    /**
     * Removes all services from the container.
     */
    public function clear(): void
    {
        $this->services        = [];
        $this->sharedInstances = [];
    }

    /**
     * Get all registered services in the container.
     *
     * @return array
     */
    public function getServices(): array
    {
        return array_keys($this->services);
    }

    /**
     * Get all shared services registered in the container.
     *
     * @return array
     */
    public function getSharedServices(): array
    {
        $sharedServices = [];

        foreach ($this->services as $id => $service) {
            if ($service['shared']) {
                $sharedServices[] = $id;
            }
        }

        return $sharedServices;
    }

    /**
     * Register multiple services at once.
     *
     * @param array $services
     */
    public function register(array $services): void
    {
        foreach ($services as $id => $service) {
            if (isset($service['class'])) {
                $class  = $service['class'];
                $shared = $service['shared'] ?? false;

                $closure = function (...$args) use ($class) {
                    return (new ReflectionClass($class))->newInstanceArgs($args);
                };

                $this->set($id, $closure, $shared);
            } elseif (isset($service['closure'])) {
                $closure = $service['closure'];
                $shared  = $service['shared'] ?? false;

                $this->set($id, $closure, $shared);
            } else {
                throw new RuntimeException("Invalid service configuration for: $id");
            }
        }
    }

    /**
     * Load all service configuration files from a directory.
     *
     * @param string $directory
     * @param string $ext
     */
    public function loadFromDirectory(string $directory, string $ext = '.php'): void
    {
        $files = glob("$directory/*$ext");

        foreach ($files as $file) {
            $this->load($file);
        }
    }


    private function getParameters(callable $callable): array
    {
        $reflection = is_array($callable)
            ? new ReflectionMethod($callable[0], $callable[1])
            : new ReflectionFunction($callable);

        $parameters = [];

        foreach ($reflection->getParameters() as $param) {
            $paramType = $param->getType();
            if ($paramType instanceof ReflectionNamedType && !$paramType->isBuiltin()) {
                $parameters[] = $paramType->getName();
            } elseif ($param->isDefaultValueAvailable()) {
                $parameters[] = $param->getDefaultValue();
            } else {
                throw new RuntimeException("Cannot resolve parameter: {$param->getName()}");
            }
        }

        return $parameters;
    }

    public function __get($key)
    {
        return $this->get($key);
    }

    public function __set($key, $value)
    {
        $this->set($key, $value);
    }

    public function __isset($key)
    {
        return $this->has($key);
    }

    public function __unset($key)
    {
        $this->remove($key);
    }
}
