<?php


namespace App;


class FrontEndView
{
    public $twig;

    public function __construct($twig)
    {
        $this->twig = $twig;
    }

    public function article($article, $categories)
    {
        return $this->twig->render('article.twig', ['article' => $article,'categories'=>$categories  ]);
    }

    public function articleList($articles, $categories)
    {
        return $this->twig->render('articles-list.twig',['articles' => $articles,'categories'=>$categories ]);
    }

}