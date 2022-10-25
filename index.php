<?php
require('vendor/autoload.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


use NoahBuscher\Macaw\Macaw;
$container = new DI\Container();

dd($container->get(\App\FrontEndController::class));

Macaw::get('/', 'App\FrontEndView@articleList');
Macaw::get('/article/(:num)', 'App\FrontEndView@article');





Macaw::dispatch();