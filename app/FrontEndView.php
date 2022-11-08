<?php


namespace App;


class FrontEndView
{
    public $twig;

    public function __construct($twig)
    {
        $this->twig = $twig;
    }

    public function article()
    {
        return $this->twig->render('article.twig');
    }
    public function articleList()
    {
        return $this->twig->render('articles-list.twig');
    }

}