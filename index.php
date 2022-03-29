<?php
/**
 * Created by PhpStorm.
 * User: 37129
 * Date: 23/02/2022
 * Time: 12:35
 */


require 'vendor/autoload.php';

session_start();

use App\View;
use App\Redirect;
use App\Controllers\HomeController;
use App\Controllers\LoginController;
use App\Controllers\LogoutController;
use App\Controllers\SignupController;
use App\Controllers\ApartmentController;
use App\Controllers\ReviewController;
use App\Controllers\ReservationController;

$dispatcher = FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $r) {

    $r->addRoute('GET', '/', [HomeController::class, 'home']);

    $r->addRoute('GET', '/apartment', [ApartmentController::class, 'create']);
    $r->addRoute('POST', '/apartment', [ApartmentController::class, 'store']);
    $r->addRoute('GET', '/apartment/{id:\d+}', [ApartmentController::class, 'show']);
    $r->addRoute('POST', '/apartment/{id:\d+}', [ApartmentController::class, 'delete']);

    $r->addRoute('GET', '/signup', [SignupController::class, 'signup']);
    $r->addRoute('POST', '/signup', [SignupController::class, 'signupSubmit']);

    $r->addRoute('GET', '/review/{id:\d+}', [ReviewController::class, 'show']);
    $r->addRoute('POST', '/review/{id:\d+}', [ReviewController::class, 'reviewSubmit']);

    $r->addRoute('GET', '/login', [LoginController::class, 'login']);
    $r->addRoute('POST', '/login', [LoginController::class, 'loginSubmit']);

    $r->addRoute('GET', '/logout', [LogoutController::class, 'logout']);

    $r->addRoute('POST', '/reserve/{id:\d+}', [ReservationController::class, 'reserve']);
});

// Fetch method and URI from somewhere

$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = explode('/',$_SERVER['REQUEST_URI']);
unset($uri[0]);unset($uri[1]);unset($uri[2]);
$uri = '/'.implode('/',$uri);

// Strip query string (?foo=bar) and decode URI
if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        // ... 404 Not Found
        echo "404 Not Found";

        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        // ... 405 Method Not Allowed
        echo "405 Method Not Allowed";

        break;
    case FastRoute\Dispatcher::FOUND:
        $controller = $routeInfo[1][0];
        $method = $routeInfo[1][1];

        $response = (new $controller)->$method($routeInfo[2]);

        $twig = new \Twig\Environment(new \Twig\Loader\FilesystemLoader('app/Views'));

        if ($response instanceof View) {
            echo $twig->render($response->getPath() . ".html", $response->getVariables());
        }
        if ($response instanceof Redirect) {
            header("Location: ". $response->getPath());
            exit;
        }
        break;
}

if (isset($_SESSION['errors'])) {
    unset($_SESSION['errors']);
}
if (isset($_SESSION['inputs'])) {
    unset($_SESSION['inputs']);
}