<?php

declare(strict_types=1);

namespace Tests;

use PHPUnit\Framework\TestCase;
use CrudApi\Types\Name;
use CrudApi\Exceptions\SetTypeException;
use PHPUnit\Framework\Attributes\DataProvider;
use TypeError;

final class NameTest extends TestCase
{
    public static function providerSet()
    {
        return [[null], ['bla-bla'], [''],];
    }

    public static function providerSetTypeException()
    {
        return [
            ['Length of this strinfg of text must be grosser than two hunderd fifty five caracters!!!' .
             'Length of this strinfg of text must be grosser than two hunderd fifty five caracters!!!' .
             'Length of this strinfg of text must be grosser than two hunderd fifty five caracters!!!'
            ],
        ];
    }

    public static function providerTypeError()
    {
        return [[42], [[]],];
    }

    #[DataProvider('providerSet')]
    public function testSet($value)
    {
        $name = new Name($value);
        $this->assertEquals($value, $name->get());
    }

    #[DataProvider('providerSetTypeException')]
    public function testSetTypeException($value)
    {
        $this->expectException(SetTypeException::class);
        $name = new Name($value);
    }

    #[DataProvider('providerTypeError')]
    public function testSetTypeError($value)
    {
        $this->expectException(TypeError::class);
        $name = new Name($value);
    }
}
