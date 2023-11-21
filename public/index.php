<?php


require_once '../vendor/autoload.php';


/* ------------
--- ROUTAGE ---
-------------*/

$router = new AltoRouter();

if (array_key_exists('BASE_URI', $_SERVER)) {
    $router->setBasePath($_SERVER['BASE_URI']);
} else {
    $_SERVER['BASE_URI'] = '/';
}


/* -----------
---  MAPS  ---
------------*/

// MAIN
$router->addRoutes([
    // home page
    ['GET', '/', '\App\Controllers\MainController@home', 'main-home']
]);

// TESTS
$router->addRoutes([
    // test get
    ['GET', '/test/[i:id]', '\App\Controllers\TestController@test', 'test-test'],
]);


/*--------------
--- DISPATCH ---
--------------*/

$match = $router->match();
$dispatcher = new Dispatcher($match, '\App\Controllers\ErrorController::error404');
$dispatcher->dispatch();