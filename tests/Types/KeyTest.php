<?php

declare(strict_types=1);

namespace Tests;

use CrudApi\Exceptions\SetTypeException;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use CrudApi\Types\Key;
use TypeError;

final class KeyTest extends TestCase
{
    public static function providerSet()
    {
        return [['some-key'], ['']];
    }

    public static function providerSetTypeException()
    {
        return [['string is more than twenty five characters length']];
    }

    public static function providerTypeError()
    {
        return [[null], [13], [[]]];
    }

    #[DataProvider('providerSet')]
    public function testSet($value)
    {
        $key = new Key($value);
        $this->assertEquals($value, $key->get());
    }

    #[DataProvider('providerSetTypeException')]
    public function testSetTypeException($value)
    {
        $this->expectException(SetTypeException::class);
        $key = new Key($value);
    }

    #[DataProvider('providerTypeError')]
    public function testTypeError($value)
    {
        $this->expectException(TypeError::class);
        $key = new Key($value);
    }
}
