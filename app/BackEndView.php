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

    public function index($categories_count, $articles_count, $tags_count, $message)
    {
        return $this->twig->render('index.twig',
            [
                'categories_count'=>$categories_count,
                'articles_count'=>$articles_count,
                'tags_count'=>$tags_count,
                'message' => $message
            ]);
    }

    public function showSignInForm($message)
    {
        return $this->twig->render('signin.twig',['message' => $message]);
    }

    public function showForgotPasswordForm($message)
    {
        return $this->twig->render('forgot-password.twig',['message' => $message]);
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
        return $this->twig->render('tags/tagslist.twig',
            [
                'tags' => $tags,
                'message' => $message
            ]);
    }

    public function showAddTagForm($tag, $target)
    {
        return $this->twig->render('tags/add-tag.twig',['tag' => $tag, 'target'=> $target]);
    }

    public function showCategoriesList($categories, $message)
    {
        return $this->twig->render('categorieslist.twig',
            [
                'categories' => $categories,
                'message' => $message
            ]);
    }

    public function showAddCategoryForm($category, $target)
    {
        return $this->twig->render('add-category.twig',['category' => $category, 'target'=> $target]);
    }

}