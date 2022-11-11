<?php
session_start();
require __DIR__ . '/vendor/autoload.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


use Tracy\Debugger;

Debugger::enable();

$router   = require ('app/config/config.php');

$request = Laminas\Diactoros\ServerRequestFactory::fromGlobals(
    $_SERVER, $_GET, $_POST, $_COOKIE, $_FILES
);

$router->map('GET', '/', 'App\FrontEndController::index');
$router->map('GET', '/article/{id:number}', 'App\FrontEndController::article');


$router->map('GET', '/admin', 'App\BackEndController::index');
$router->map('GET', '/signin', 'App\BackEndController::showSignInForm');
$router->map('POST', '/signin', 'App\BackEndController::UserSignIn');
$router->map('GET', '/signup', 'App\BackEndController::showSignUpForm');
$router->map('POST', '/signup', 'App\BackEndController::UserSignUp');
$router->map('GET', '/admin/users', 'App\BackEndController::showUserList');

$response = $router->dispatch($request);

// send the response to the browser
(new Laminas\HttpHandlerRunner\Emitter\SapiEmitter)->emit($response);
