<?php

declare(strict_types=1);

namespace Tests;

use CrudApi\Exceptions\SetTypeException;
use PHPUnit\Framework\TestCase;
use CrudApi\Types\Phone;
use PHPUnit\Framework\Attributes\DataProvider;
use TypeError;

final class PhoneTest extends TestCase
{
    public static function providerSet()
    {
        return [[null], ['some-phone'],];
    }

    public static function providerSetTypeException()
    {
        return [['string with lengt more than fifteen characters'],];
    }

    public static function providerTypeError()
    {
        return [[14], [[]],];
    }

    #[DataProvider('providerSet')]
    public function testSet($value)
    {
        $phone = new Phone($value);
        $this->assertEquals($value, $phone->get());
    }

    #[DataProvider('providerSetTypeException')]
    public function testSetTypeException($value)
    {
        $this->expectException(SetTypeException::class);
        $phone = new Phone($value);
    }

    #[DataProvider('providerTypeError')]
    public function testTypeError($value)
    {
        $this->expectException(TypeError::class);
        $phone = new Phone($value);
    }
}
