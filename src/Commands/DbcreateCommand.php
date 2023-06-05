<?php

declare(strict_types=1);

namespace CrudApi\Commands;

use PDO;

class DbcreateCommand extends Command
{
    public function execute(CommandContext $context): bool
    {
        $dbh = new PDO(
            "mysql:host={$context->get('host')}",
            $context->get('username'),
            $context->get('password')
        );
        $dbh->exec("DROP DATABASE IF EXISTS {$context->get('database')}");
        $dbh->exec("CREATE DATABASE {$context->get('database')}");
        $dbh->exec("USE {$context->get('database')}");
        $dbh->exec("DROP TABLE IF EXISTS item");
        $dbh->exec(
            "CREATE TABLE IF NOT EXISTS item (" .
            "id INTEGER NOT NULL auto_increment PRIMARY KEY, " .
            "name VARCHAR(255), " .
            "phone VARCHAR(15), " .
            "sequre_key VARCHAR(25), " .
            "created_at DATETIME DEFAULT CURRENT_TIMESTAMP, " .
            "updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP" .
            ")");
        return true;
    }
}
