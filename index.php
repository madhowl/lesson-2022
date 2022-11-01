<?php
require('vendor/autoload.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


use NoahBuscher\Macaw\Macaw;


Macaw::get('/', 'App\FrontEndView@articleList');
Macaw::get('/article/(:num)', 'App\FrontEndView@article');
Macaw::get('/admin', 'App\BackEndView@index');
Macaw::get('/signin', 'App\BackEndController@showSignInForm');
Macaw::get('/signup', 'App\BackEndController@showSignUpForm');
Macaw::get('/admin/1', 'App\BackEndController@showDashboard');





Macaw::dispatch();