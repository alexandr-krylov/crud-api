<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use CrudApi\Controllers\{GetController, PostController, PutController, DeleteController};
use CrudApi\Services\{GetService, PostService, PutService, DeleteService};
use CrudApi\Commands\CommandFactory;
use CrudApi\Router;
// use CrudApi\Types\Request;

var_dump(PHP_SAPI);
if (PHP_SAPI == 'cli') {
    var_dump($_REQUEST);
    var_dump($argv);
    CommandFactory::create($argv[1])->execute();
} else {
    var_dump($_SERVER);
    var_dump($_REQUEST);
    $method = $_SERVER['REQUEST_METHOD'];
    $request = $_REQUEST;
    echo match ($method) {
        'GET' => (new GetController(new GetService()))->getResponse($request),
        'POST' => (new PostController(new PostService()))->getResponse($request),
        'PUT' => (new PutController(new PutService()))->getResponse($request),
        'DELETE' => (new DeleteController(new DeleteService()))->getResponse($request)
    };
}
