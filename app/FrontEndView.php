<?php


namespace App;


class FrontEndView extends Core\CoreView
{

    public function __construct($path = 'templates/frontend/')
    {
        parent::__construct($path);
    }

    public function article()
    {
        echo $this->twig->render('article.twig');
    }
    public function articleList()
    {
        echo $this->twig->render('articles-list.twig');
    }

}