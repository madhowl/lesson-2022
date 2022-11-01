<?php
declare(strict_types=1);


namespace App;


class BackEndView extends Core\CoreView
{
    public function __construct($path = 'templates/backend/')
    {
        parent::__construct($path);
    }

    public function index()
    {
        echo $this->twig->render('index.twig');
    }

    public function showSignInForm()
    {
        echo $this->twig->render('signin.twig');
    }

    public function showSignUpForm()
    {
        echo $this->twig->render('signup.twig');
    }

}