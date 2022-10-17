<?php
require('vendor/autoload.php');

use NoahBuscher\Macaw\Macaw;

Macaw::get('/', 'User\Lesson2022\Controller@index');
Macaw::get('page', 'User\Lesson2022\Controller@page');
Macaw::get('view/(:num)', 'User\Lesson2022\Controller@view');
Macaw::get('user/edit/(:num)', 'User\Lesson2022\Controller@user');



Macaw::dispatch();