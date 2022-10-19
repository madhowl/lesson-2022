<?php
require('vendor/autoload.php');

use NoahBuscher\Macaw\Macaw;

Macaw::get('/', 'Todo\TodoController@index');
Macaw::post('/add', 'Todo\TodoController@add');
Macaw::get('/del/(:num)', 'Todo\TodoController@del');
Macaw::get('/change/(:num)', 'Todo\TodoController@change');
Macaw::get('/edit/(:num)', 'Todo\TodoController@edit');
Macaw::post('/update', 'Todo\TodoController@update');




Macaw::dispatch();