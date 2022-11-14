<?php
declare(strict_types=1);


namespace App;


class BackEndView
{
    public $twig;

    public function __construct($twig)
    {
        $this->twig = $twig;
    }

    public function index()
    {
        return $this->twig->render('index.twig');
    }

    public function showSignInForm()
    {
        return $this->twig->render('signin.twig');
    }

    public function showSignUpForm()
    {
        return $this->twig->render('signup.twig');
    }
    public function showUserList($users)
    {
        return $this->twig->render('userlist.twig',['users' => $users]);
    }
    public function showArticlesList($articles)
    {
        return $this->twig->render('articleslist.twig',['articles' => $articles]);
    }

}