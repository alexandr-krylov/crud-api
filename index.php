<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use CrudApi\Commands\CommandContext;
use CrudApi\Controllers\{GetController, PostController, PutController, DeleteController};
use CrudApi\Services\{GetService, PostService, PutService, DeleteService};
use CrudApi\Commands\CommandFactory;

if (PHP_SAPI == 'cli') {
    $context = new CommandContext();
    CommandFactory::create($argv[1])->execute($context);
} else {
    $method = $_SERVER['REQUEST_METHOD'];
    $request = $_REQUEST;
    echo match ($method) {
        'GET' => (new GetController(new GetService()))->getResponse($request),
        'POST' => (new PostController(new PostService()))->getResponse($request),
        'PUT' => (new PutController(new PutService()))->getResponse($request),
        'DELETE' => (new DeleteController(new DeleteService()))->getResponse($request)
    };
}
