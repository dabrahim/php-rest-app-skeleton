<?php

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/core/autoload.php';
require __DIR__ . '/core/config.php';
require __DIR__ . '/persistence/CustomPDO.class.php';

$klein = new \Klein\Klein();

$klein->respond(function ($request, $response, $service, $app) {
    /**
     * Here go your custom helper methods
     */
    $app->register('someMethod', function () {
       return 'some result';
    });
});

/**
 * Looping through the list of sections and registering it
 * to our internal router
 */
foreach(SECTIONS as $controller) {
    $routes = "controllers/$controller.php";

    if (!file_exists($routes)) {
        copy(__DIR__ . '/core/defaultController.php', __DIR__ . '/' . $routes);
    }

    // Include all routes defined in a file under a given namespace
    $klein->with("/" .BASE_DIR. "$controller", $routes);
}

/**
 * When the requested endpoint was not found
 * or something bad happened
 */
$klein->onHttpError(function ($code, $router) {
    if ($code >= 400 && $code < 500) {
        $router->response()->body(
            'Oh no, a bad error happened that caused a '. $code
        );
    } elseif ($code >= 500 && $code <= 599) {
        error_log('uhhh, something bad happened');
    }
});

$klein->dispatch();
