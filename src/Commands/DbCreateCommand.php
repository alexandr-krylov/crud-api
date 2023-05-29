<?php

declare(strict_types=1);

namespace CrudApi\Commands;

use PDO;

class DbCreateCommand extends Command
{
    public function execute(CommandContext $context): bool
    {
        $dbh = new PDO(
            "mysql:host=$context->get('host')",
            $context->get('username'), $context->get('password')
        );
        $dbh->exec("CREATE DATABASE $context->get('database')");
        return true;
    }
}
