<?php


namespace App;


class FrontEndView extends Core\CoreView
{

    public function __construct($path = 'templates/frontend/')
    {
        parent::__construct($path);
    }

    public function index()
    {
        echo $this->twig->render('frontend/index.twig');
    }
}