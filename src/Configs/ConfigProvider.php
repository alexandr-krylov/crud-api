<?php

declare(strict_types=1);

namespace CrudApi\Configs;

use CrudApi\Exceptions\ConfigException;

class ConfigProvider
{
    private static ConfigProvider $instance = null;
    private array $config;
    private function __construct()
    {
    }
    private function __clone()
    {
    }
    public function __wakeup()
    {
        throw new ConfigException('Cannot unserialize config provider');
    }
    public static function getInstance(): ConfigProvider
    {
        if (isset(self::$instance)) {
            return self::$instance;
        }
        self::$instance = new static();
        return self::$instance;
    }
    public function init(array $config)
    {
        $this->config = $config;
    }
    public function get(string $key)
    {
        if (key_exists($key, $this->config)) {
            return $this->config[$key];
        }
        throw new ConfigException("Config record $key don't exist");
    }
}
