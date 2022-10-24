<?php
require('vendor/autoload.php');

use NoahBuscher\Macaw\Macaw;

Macaw::get('/', 'App\FrontEndView@index');





Macaw::dispatch();