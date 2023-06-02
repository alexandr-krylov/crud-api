<?php

declare(strict_types=1);

namespace CrudApi\Commands;

use CrudApi\Exceptions\CommandException;

class CommandFactory
{
    public static function create(string $action = 'Default'): Command
    {
        if (preg_match('/\W/', $action)) {
            throw new CommandException("Wrong command name");
        }
        $class = __NAMESPACE__ . "\\" . ucfirst(strtolower($action)) . "Command";
        if (! class_exists($class)) {
            throw new CommandException("Class '$class' not found");
        }
        return new $class();
    }
}
