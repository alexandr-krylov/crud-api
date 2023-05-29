<?php

declare(strict_types=1);

namespace Tests\Commands;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\DataProvider;
use CrudApi\Commands\CommandContext;

final class CommandContextTest extends TestCase
{
    public static function providerConstruct()
    {
        return [
            [['key1' => 'value1', 'key2' => 'value2']]
        ];
    }

    public static function providerError()
    {
        return [
            ["Error number 1"], ["Error number 2"]
        ];
    }

    #[DataProvider('providerConstruct')]
    public function testConstruct($params)
    {
        $cc = new CommandContext($params);
        foreach ($params as $key => $value) {
            $this->assertEquals($value, $cc->get($key));
        }
    }

    #[DataProvider('providerConstruct')]
    public function testAddParam(array $param)
    {
        $cc = new CommandContext();
        foreach ($param as $key => $value) {
            $cc->addParam($key, $value);
            $this->assertEquals($value, $cc->get($key));
        }
    }

    #[DataProvider('providerConstruct')]
    public function testGetNull(array $param)
    {
        $cc = new CommandContext($param);
        $this->assertNull($cc->get('unknownkey'));
    }

    #[DataProvider('providerError')]
    public function testError(string $error)
    {
        $cc = new CommandContext();
        $cc->setError($error);
        $this->assertEquals($error, $cc->getError());
    }
}
