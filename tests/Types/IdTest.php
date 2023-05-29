<?php

declare(strict_types=1);

namespace Tests;

use PHPUnit\Framework\TestCase;
use CrudApi\Types\Id;
use CrudApi\Exceptions\SetTypeException;
use PHPUnit\Framework\Attributes\DataProvider;
use TypeError;

final class IdTest extends TestCase
{
    public static function providerSetTypeException()
    {
        return[[-1], [0]];
    }

    public static function providerTypeError()
    {
        return [[3.14], [-3.14], ['14']];
    }

    public static function providerSet()
    {
        return [[1], [1000000]];
    }

    #[DataProvider('providerSetTypeException')]
    public function testSetTypeException($value)
    {
        $this->expectException(SetTypeException::class);
        $id = new Id($value);
    }

    #[DataProvider('providerTypeError')]
    public function testSetTypeError($value)
    {
        $this->expectException(TypeError::class);
        $id = new Id($value);
    }

    #[DataProvider('providerSet')]
    public function testSet($value)
    {
        $id = new Id($value);
        $this->assertEquals($value, $id->get());
    }
}
