<?php
declare(strict_types=1);

require('vendor/autoload.php');

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use \App\Middleware\AuthMiddleware;
use Tracy\Debugger;

Debugger::enable();

$container = new League\Container\Container();
$connectionParams = include ('app/config/db.php');


$container->add('Response',Laminas\Diactoros\Response::class);
$container->add('Model',\Scrawler\Arca\Database::class)
    ->addArgument($connectionParams);

// Frontend template init
$container->add('FrontTwigLoader',\Twig\Loader\FilesystemLoader::class)
    ->addArgument('templates/frontend');

$container->add('FrontTwig',\Twig\Environment::class)
    ->addArgument($container->get('FrontTwigLoader'))
    ->addArgument(['debug' => true]);

$container->add(\App\FrontEndView::class)
    ->addArgument(
        $container->get('FrontTwig')
    );

$container->add(\App\FrontEndController::class)
    ->addArgument($container->get('Model'))
    ->addArgument(\App\FrontEndView::class)
    ->addArgument($container->get('Response'));


// Backend template init
$container->add('BackTwigLoader',\Twig\Loader\FilesystemLoader::class)
    ->addArgument('templates/backend');

$container->add('BackTwig',\Twig\Environment::class)
    ->addArgument($container->get('BackTwigLoader'))
    ->addArgument(['debug' => true]);

$container->add(\App\BackEndView::class)
    ->addArgument(
        $container->get('BackTwig')
    );
$container->add(\App\BackEndController::class)
    ->addArgument($container->get('Model'))
    ->addArgument(\App\BackEndView::class)
    ->addArgument($container->get('Response'));





$strategy = (new League\Route\Strategy\ApplicationStrategy)->setContainer($container);
$router   = (new League\Route\Router)->setStrategy($strategy);
//$router->middleware(new AuthMiddleware);
 return $router;