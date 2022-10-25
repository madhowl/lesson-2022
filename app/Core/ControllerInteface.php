<?php


namespace App\Core;


interface ControllerInteface
{


    public function __construct(ModelInterface $model,ViewInterface $view);
}