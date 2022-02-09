<?php

# Add Routing Middleware
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface;
use Slim\Psr7\Response as Psr7Response;

#Add Error Handling Middleware
$errorMiddleware = $app->addErrorMiddleware($displayErrorDetails, false, false);
$errorMiddleware->setDefaultErrorHandler($errorHandler);

$beforeMiddleware = function (Request $request, RequestHandlerInterface $handler) {
    $response = $handler->handle($request);
    $existingContent = (string) $response->getBody();

    $response = new Psr7Response();
    $response->getBody()->write('BEFORE ' . $existingContent);

    return $response;
};

$afterMiddleware = function ($request, $handler) {
    $response = $handler->handle($request);
    $response->getBody()->write(' AFTER');
    return $response;
};