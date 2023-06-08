<?php

declare(strict_types=1);

namespace CrudApi\Commands;

use Firebase\JWT\JWT;
use CrudApi\Configs\ConfigProvider;

class TokenissueCommand extends Command
{
    public function execute(CommandContext $context): bool
    {
        $configProvider = ConfigProvider::getInstance();
        $key = $configProvider->get('secret_key');
        $payload = [
            'vip' => 'very important payload',
        ];
        $jwt = JWT::encode($payload, $key, 'HS256');
        print_r("\n" . $jwt . "\n");
        return true;
    }
}
