<?php
session_start();
require __DIR__ . '/../vendor/autoload.php';

$dispatcher = FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $r) {

    $homeController = new Me\Task7\Controllers\HomeController();
    $aboutController = new Me\Task7\Controllers\AboutController();
    $contactsController = new Me\Task7\Controllers\ContactsController();
    $catalogueController = new Me\Task7\Controllers\CatalogueController();
    $loginController = new Me\Task7\Controllers\LoginController();
// Define your routes here
    $r->addRoute('GET', '/', [$homeController, 'index']);
    $r->addRoute('GET', '/home', [$homeController, 'index']);
    $r->addRoute('GET', '/about', [$aboutController, 'index']);
    $r->addRoute('GET', '/contacts', [$contactsController, 'index']);
    $r->addRoute('GET', '/catalogue',[$catalogueController,'index']);
    $r->addRoute('GET', '/login',[$loginController,'index']);
    $r->addRoute('POST', '/login', [$loginController, 'auth']);
    });

// Fetch method and URI from somewhere
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

// Strip query string (?foo=bar) and decode URI
if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        // ... 404 Not Found
        header('Location: /');
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        // ... 405 Method Not Allowed
        header('Location: /');
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];
        if (is_callable($handler)) {
            call_user_func($handler, $vars);
        } else {
            $handler->handle($handler, $vars);
        }
        break;
}