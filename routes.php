<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

// Define app routes
$app->get('/', function (Request $request, Response $response) {
    $response->getBody()->write("Success, Congrats!");
    return $response;
})->add($beforeMiddleware);

$app->get('/abc', function (Request $request, Response $response) {
    $response->getBody()->write("Success ABC, Congrats!");
    return $response;
})->add($afterMiddleware);

$app->get('/def', function (Request $request, Response $response) {
    $response->getBody()->write("Omaewa mo shiteyiru");
})->add($beforeMiddleware);

$app->get('/hello/{name}', function (Request $request, Response $response, $args) {
    $name = $args['name'];
    $response->getBody()->write("Hello, $name");
    return $response;
});

// Run app
$app->run();