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

    public function index($categories_count, $articles_count, $tags_count, $message, $user)
    {
        return $this->twig->render('index.twig',
            [
                'categories_count'=>$categories_count,
                'articles_count'=>$articles_count,
                'tags_count'=>$tags_count,
                'message' => $message,
                'user' => $user
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

    public function showUserList($users, $user)
    {
        return $this->twig->render('userlist.twig',['users' => $users, 'user' => $user]);
    }

    public function showArticlesList($articles, $categories, $message, $user)
    {
        return $this->twig->render(
            'articleslist.twig',
            [
                'articles' => $articles,
                'categories' => $categories,
                'message' => $message,
                'user' => $user
            ]);
    }

    public function showAddArticleForm($article, $categories, $target, $tags, $user, $selected_tag = [])
    {
        return $this->twig->render(
            'add-article.twig',
            [
                'article' => $article,
                'categories'=>$categories,
                'target'=> $target,
                'tags' => $tags,
                'selected_tag' => $selected_tag,
                'user' => $user
            ]);
    }

    public function showTagsList($tags, $message, $user)
    {
        return $this->twig->render('tags/tagslist.twig',
            [
                'tags' => $tags,
                'message' => $message,
                'user' => $user
            ]);
    }

    public function showAddTagForm($tag, $target, $user)
    {
        return $this->twig->render('tags/add-tag.twig',
            [
                'tag' => $tag,
                'target'=> $target,
                'user' => $user
            ]);
    }

    public function showCategoriesList($categories, $message, $user)
    {
        return $this->twig->render('categorieslist.twig',
            [
                'categories' => $categories,
                'message' => $message,
                'user' => $user
            ]);
    }

    public function showAddCategoryForm($category, $target, $user)
    {
        return $this->twig->render('add-category.twig',
            [
                'category' => $category,
                'target'=> $target,
                'user' => $user
            ]);
    }

}