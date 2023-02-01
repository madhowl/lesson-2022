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


$router->map('GET', '/signin', 'App\BackEndController::showSignInForm');
$router->map('POST', '/signin', 'App\BackEndController::UserSignIn');
$router->map('GET', '/signup', 'App\BackEndController::showSignUpForm');
$router->map('POST', '/signup', 'App\BackEndController::UserSignUp');

$router->map('GET', '/forgot', 'App\BackEndController::showForgotPasswordForm');
$router->map('POST', '/forgot', 'App\BackEndController::forgotUserPassword');

$router->map('GET', '/password-reset/{email}/{token}', 'App\BackEndController::passswordReset');
$router->map('GET', '/confirm/{email}/{token}', 'App\BackEndController::confirmEmail');

$router->map('GET', '/test', 'App\Models\Article::test');

$router->group('/admin', function (\League\Route\RouteGroup $router) {
    $router->map('GET', '/', 'App\BackEndController::index');
    $router->map('GET', '/logout', 'App\BackEndController::userLogOut');
    $router->map('GET', '/filemanager', 'App\BackEndController::filemanager');
    $router->map('GET', '/users', 'App\BackEndController::showUsersList');

    $router->map('GET', '/articles', 'App\BackEndController::showArticlesList');
    $router->map('GET', '/article-add', 'App\BackEndController::showAddArticleForm');
    $router->map('POST', '/article-add', 'App\BackEndController::insertArticle');
    $router->map(
        'GET',
        '/article-edit/{id:number}',
        'App\BackEndController::showUpdateArticleForm'
    );
    $router->map(
        'POST',
        '/article-update/{id:number}',
        'App\BackEndController::updateArticle'
    );
    $router->map('GET', '/tags', 'App\BackEndController::showTagsList');
    $router->map('GET', '/tag-add', 'App\BackEndController::showAddTagForm');
    $router->map('POST', '/tag-add', 'App\BackEndController::insertTag');
    $router->map(
        'GET',
        '/tag-edit/{id:number}',
        'App\BackEndController::showUpdateTagForm'
    );
    $router->map(
        'POST',
        '/tag-update/{id:number}',
        'App\BackEndController::updateTag'
    );
    $router->map('GET', '/categories', 'App\BackEndController::showCategoriesList');
    $router->map('GET', '/category-add', 'App\BackEndController::showAddCategoryForm');
    $router->map('POST', '/category-add', 'App\BackEndController::insertCategory');
    $router->map(
        'GET',
        '/category-edit/{id:number}',
        'App\BackEndController::showUpdateCategoryForm'
    );
    $router->map(
        'POST',
        '/category-update/{id:number}',
        'App\BackEndController::updateCategory'
    );
})->middleware(new \App\Middleware\AuthMiddleware);

$response = $router->dispatch($request);

// send the response to the browser
(new Laminas\HttpHandlerRunner\Emitter\SapiEmitter)->emit($response);
