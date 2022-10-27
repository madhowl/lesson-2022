<?php
declare(strict_types=1);
require __DIR__ . '/../vendor/autoload.php';
$db = include_once './config/db.php';
$container = new League\Container\Container();

$container
    ->add(PDO::class)
    ->addArgument($db['dsn_string'])
    ->addArgument($db['username'])
    ->addArgument($db['password'])
;
$container->add('FrontController', \App\FrontEndController::class)
    ->addArgument(\App\Core\CoreModel::class)
    ->addArgument(\App\FrontEndView::class);
$container->add('Model', \App\Core\CoreModel::class)
    ->addArgument(PDO::class)
    ->addArgument('tablename', 'test');
$container->add('FrontView', \App\FrontEndView::class);

$app = $container->get('FrontController');
$app->test();