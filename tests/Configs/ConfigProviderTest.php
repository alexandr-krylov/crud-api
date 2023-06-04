<?php

declare(strict_types=1);

namespace Tests\Configs;

use PHPUnit\Framework\TestCase;
use CrudApi\Configs\ConfigProvider;
use CrudApi\Exceptions\ConfigException;
use Error;
use PHPUnit\Framework\Attributes\DataProvider;

final class ConfigProviderTest extends TestCase
{
    public static function initProvider()
    {
        return [
            [
                [
                    'db' =>
                    [
                        'database' => 'crud-api',
                        'username' => 'root',
                        'password' => 'example'
                    ],
                ]
            ]
        ];
    }
    public static function getExceptionProvider()
    {
        return [
            [
                [
                    'db' => 'some db config',
                ],
                'wrongKey',
            ],
        ];
    }
    public function testGetInstance()
    {
        $this->assertInstanceOf(ConfigProvider::class, ConfigProvider::getInstance());
    }
    public function testGetThesameInstance()
    {
        $configProvider = ConfigProvider::getInstance();
        $this->assertSame($configProvider, ConfigProvider::getInstance());
    }
    public function testConstructError()
    {
        $this->expectException(Error::class);
        new ConfigProvider();
    }
    public function testCloneError()
    {
        $this->expectException(Error::class);
        $configProvider = ConfigProvider::getInstance();
        clone $configProvider;
    }
    public function testWakeupException()
    {
        $configProvider = ConfigProvider::getInstance();
        $serialized = serialize($configProvider);
        $this->expectException(ConfigException::class);
        unserialize($serialized);
    }
    #[DataProvider('initProvider')]
    public function testInitGet(array $initArray)
    {
        $configProvider = ConfigProvider::getInstance();
        $configProvider->init($initArray);
        foreach ($initArray as $key => $value) {
            $this->assertSame($value, ConfigProvider::getInstance()->get($key));
        }
    }
    #[DataProvider('getExceptionProvider')]
    public function testGetException(array $initArray, string $wrongKey)
    {
        $configProvider = ConfigProvider::getInstance();
        $configProvider->init($initArray);
        $this->expectException(ConfigException::class);
        $configProvider->get($wrongKey);
    }
}
