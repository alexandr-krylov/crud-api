<?php

declare(strict_types=1);

namespace CrudApi\Commands;

use PDO;
use CrudApi\Configs\ConfigProvider;

class DbcreateCommand extends Command
{
    public function execute(CommandContext $context): bool
    {
        $configProvider = ConfigProvider::getInstance();
        $config = $configProvider->get('db');
        $dbh = new PDO(
            "mysql:host={$config['host']}",
            $config['username'],
            $config['password']
        );
        $dbh->exec("DROP DATABASE IF EXISTS {$config['database']}");
        $dbh->exec("CREATE DATABASE {$config['database']}");
        $dbh->exec("USE {$config['database']}");
        $dbh->exec("DROP TABLE IF EXISTS item");
        $dbh->exec(
            "CREATE TABLE IF NOT EXISTS item (" .
            "id INTEGER NOT NULL auto_increment PRIMARY KEY, " .
            "name VARCHAR(255), " .
            "phone VARCHAR(15), " .
            "sequre_key VARCHAR(25), " .
            "created_at DATETIME DEFAULT CURRENT_TIMESTAMP, " .
            "updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP" .
            ")"
        );
        return true;
    }
}
