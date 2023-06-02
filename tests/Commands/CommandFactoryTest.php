<?php

declare(strict_types=1);

namespace Tests\Commands;

use CrudApi\Commands\Command;
use PHPUnit\Framework\TestCase;
use CrudApi\Commands\CommandFactory;
use PHPUnit\Framework\Attributes\DataProvider;
use CrudApi\Exceptions\CommandException;
use CrudApi\Commands\DefaultCommand;

final class CommandFactoryTest extends TestCase
{
    public static function actionExceptionProvider()
    {
        return [
            ['Wrong!name'], ['NotExistingName']
        ];
    }
    public static function actionCreateProvider()
    {
        return [
            ['dbcreate'],
        ];
    }
    #[DataProvider('actionExceptionProvider')]
    public function testCommandException($action)
    {
        $this->expectException(CommandException::class);
        CommandFactory::create($action);
    }
    #[DataProvider('actionCreateProvider')]
    public function testCommandCreate($action)
    {
        $this->assertInstanceOf(
            Command::class,
            CommandFactory::create($action)
        );
    }
    public function testCommandDefaultCreate()
    {
        $this->assertInstanceOf(
            DefaultCommand::class,
            CommandFactory::create()
        );
    }
}
