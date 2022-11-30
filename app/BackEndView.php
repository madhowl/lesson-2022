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
    public function showArticlesList($articles, $categories, $message)
    {
        return $this->twig->render(
            'articleslist.twig',
            [
                'articles' => $articles,
                'categories' => $categories,
                'message' => $message
            ]);
    }
    public function showAddArticleForm($article, $categories, $target, $tags, $selected_tag = [])
    {
        return $this->twig->render(
            'add-article.twig',
            [
                'article' => $article,
                'categories'=>$categories,
                'target'=> $target,
                'tags' => $tags,
                'selected_tag' => $selected_tag
            ]);
    }

    public function showTagsList($tags, $message)
    {
        return $this->twig->render('tagslist.twig',['tags' => $tags, 'message' => $message]);
    }

    public function showAddTagForm($tag, $target)
    {
        return $this->twig->render('add-tag.twig',['tag' => $tag, 'target'=> $target]);
    }

}