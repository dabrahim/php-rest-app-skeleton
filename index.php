<?php

ob_start();

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/core/autoload.php';
require __DIR__ . '/core/config.php';

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
        $router->response()->body(json_encode(array(
            'success' => false,
            'message' => 'Oh no, a bad error happened that caused a '. $code
        )));
    } elseif ($code >= 500 && $code <= 599) {
        error_log('uhhh, something bad happened');
    }
});

$klein->dispatch();


/**
 * Saving the response into a variable
 */
$response = ob_get_clean();

/**
 * If log recording is enabled, then each request to
 * the API is saved to the database
 */
if (LOG_REQUESTS) {
    $requestLog = new RequestLog();
    $requestLog->setResponse($response);
    RequestLogService::save($requestLog);
}

/**
 * Finally, we return the response to the user
 */
echo $response;
