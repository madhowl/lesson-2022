<?php
declare(strict_types=1);


namespace App;


use App\Core\Auth;
use Laminas\Diactoros\Response;
use Laminas\Diactoros\Response\RedirectResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Scrawler\Arca\Database;
use SimpleValidator\Validator;
use EasySlugger\Slugger;

class BackEndController
{
use Auth;

    private  BackEndView $View;
    private  Database $Model;

    public function __construct(Database $Model, BackEndView $View)
    {
        $this->View = $View;
        $this->Model = $Model;
    }

    public function responseWrapper(string $str):ResponseInterface
    {
        $response = new Response;
        $response->getBody()->write($str);
        return $response;
    }

    public function goUrl(string $url)
    {
        return $response = new RedirectResponse($url);
    }

    public function index(ServerRequestInterface $request): ResponseInterface
    {
        return $this->showDashboard($request);
    }

    public function setMessage($text, $color = 'success', $position = 'top right' )
    {
      $_SESSION['message'] =
          [
              'color'=>$color,
              'text'=>$text,
              'position'=>$position
          ];
    }
    public function getMessage()
    {
        $message = null;
        if (isset($_SESSION['message'])){
            $message = $_SESSION['message'];
            unset($_SESSION['message']);
        }
        return $message;
    }
    /**
     * Эти методы относится к модели - нужно определиться выносить модели в отдельный класс
     * или оставлять в этом...
     */
    public function getUserByEmail(string $email)
    {
        $users = $this->Model->find('users')
            ->where('email = :email')
            ->setParameter('email',$email)
            ->first();
        return $users->toArray();
    }

    public function getAll(string $tablename):array
    {
        $all = $this->Model->get($tablename);
        return $all->toArray();
    }

    public function getById(string $tablename,  $id)
    {
        $all = $this->Model->get($tablename,$id);
        return $all->toArray();
    }


    /**
    * end Model
     **/


    public function UserSignIn(ServerRequestInterface $request): ResponseInterface
    {
        $requestBody = $request->getParsedBody();
        $user = $this->getUserByEmail($requestBody['email']);
        if (empty($user)){
            return $this->responseWrapper('User not found...');
        }else{
            if (password_verify($requestBody['password'],$user['password']))
            {
                //return $this->responseWrapper('Ok');
                $this->signIn($user['username'],$user['id']);
                return $this->goUrl('/admin');
            }else{
                $r = $this->responseWrapper('Неверный пароль');
                dd($r);
            }
        }

    }

    public function userLogOut(ServerRequestInterface $request): ResponseInterface
    {
        $this->signOut();
        return $this->goUrl('/admin');
    }

    public function UserSignUp(ServerRequestInterface $request): ResponseInterface
    {
        $requestBody = $request->getParsedBody();
        $rules = [
            'username' => [
                'required',
                'alpha',
                'min_length(5)',
                'max_length(50)'
            ],
            'email' => [
                'required',
                'email'
            ],
            'password' => [
                'required',
                'min_length(5)',
                'max_length(50)',
                'equals(:password_verify)'
            ],
            'password_verify' => [
                'required'
            ]
        ];
        $validation_result = Validator::validate($requestBody, $rules);
        if ($validation_result->isSuccess() == true) {
            $user = $this->getUserByEmail($requestBody['email']);
            if (empty($user)){
                $user = $this->Model->create('users');
                $user->username = $requestBody['username'];
                $user->email = $requestBody['email'];
                $user->password = password_hash($requestBody['password'], PASSWORD_DEFAULT);
                $user->save();
                return $this->responseWrapper('User sign up is OK!');
            } else {
                return $this->responseWrapper('Email is used ;(');
            }
        }else{
            echo "validation not ok";
            dd($validation_result->getErrors());
        }
    }

    public function showDashboard(ServerRequestInterface $request): ResponseInterface
    {
        $html = $this->View->index();
        return $this->responseWrapper($html);
    }

    public function showSignInForm(ServerRequestInterface $request): ResponseInterface
    {
        $html =$this->View->showSignInForm();
        return $this->responseWrapper($html);
    }

    public function showSignUpForm(ServerRequestInterface $request): ResponseInterface
    {
        $html = $this->View->showSignUpForm();
        return $this->responseWrapper($html);
    }

    public function showUsersList(ServerRequestInterface $request): ResponseInterface
    {
        $users = $this->getAll('users');
        $html = $this->View->showUserList($users);
        return $this->responseWrapper($html);
    }

    public function showArticlesList(ServerRequestInterface $request): ResponseInterface
    {
        $articles = $this->getAll('articles');
        $categories = $this->getAll('categories');
        $message = $this->getMessage();
        $html = $this->View->showArticlesList($articles,$categories, $message);
        return $this->responseWrapper($html);
    }

    public function showAddArticleForm(ServerRequestInterface $request): ResponseInterface
    {   $article = [];
        $tags = $this->getAll('tags');
        $categories = $this->getAll('categories');
        $target = 'article-add';
        $html = $this->View->showAddArticleForm($article, $categories, $target, $tags);
        return $this->responseWrapper($html);
    }

    public function showUpdateArticleForm(ServerRequestInterface $request, array $arg): ResponseInterface
    {
        $article = $this->getById('articles', $arg['id']);
        $selected_tag = $this->Model->find('article_tag' )
            ->select('tag_id')
            ->where('article_id = :id')
            ->setParameter('id',$arg['id'])
            ->get()
            ->toArray();
        $tags = $this->getAll('tags');
        $categories = $this->getAll('categories');
        $target = 'article-update/'.$arg['id'];
        $html = $this->View->showAddArticleForm($article, $categories, $target, $tags, $selected_tag );
        return $this->responseWrapper($html);
    }

    public function saveArticle(array $requestBody,  $id)
    {
        if ($id <> null){
            $article = $this->Model->get('articles',$id);
        }else{
            $article = $this->Model->create('articles');
        }
        $article->title = $requestBody['title'];
        $article->slug = Slugger::slugify($requestBody['title']);
        $article->intro_image = $requestBody['intro_image'];
        $article->intro_text = $requestBody['intro_text'];
        $article->categories_id = $requestBody['category'];
        $article->user_id = $_SESSION['user_id'];
        $article->content = $requestBody['content'];
        $date = date('Y-m-d H:i:s', time());
        $article->created_at = $date;
        $article->deleted_at = 0;
        $article->favorites = 0;
        $article->save();

        if (isset($requestBody['tags'])) {
            $qb = $this->Model->connection
                ->createQueryBuilder()
                ->delete('article_tag', 'at')
                ->where('at.article_id = :id')
                ->setParameter('id', $article->id)
                ->executeQuery();

            foreach ($requestBody['tags'] as $tag) {
                $article_tag = $this->Model->create('article_tag');
                $article_tag->article_id = $article->id;
                $article_tag->tag_id = $tag;
                $article_tag->save();
            }
        }
    }

    public function insertArticle(ServerRequestInterface $request): ResponseInterface
    {
        $requestBody = $request->getParsedBody();
        $this->saveArticle($requestBody,$id = null);
        $this->setMessage('Статья добавлена успешно ;)');
        return $this->goUrl('/admin/articles');
    }

    public function updateArticle(ServerRequestInterface $request, array $arg): ResponseInterface
    {
        $requestBody = $request->getParsedBody();
        $this->saveArticle($requestBody, $arg['id']);
        $this->setMessage('Изменения выполнены успешно');
        return $this->goUrl('/admin/articles');
    }

    public function showTagList(ServerRequestInterface $request): ResponseInterface
    {
        $tags = $this->getAll('tags');
        $message = $this->getMessage();
        $html = $this->View->showTagsList($tags, $message );
        return $this->responseWrapper($html);
    }

    public function showAddTagForm(ServerRequestInterface $request): ResponseInterface
    {   $tag = [];
        $target = 'tag-add';
        $html = $this->View->showAddTagForm($tag, $target );
        return $this->responseWrapper($html);
    }

    public function insertTag(ServerRequestInterface $request): ResponseInterface
    {
        $requestBody = $request->getParsedBody();
        $this->saveTag($requestBody,$id = null);
        $this->setMessage('Тэг добавлен успешно ;)');
        return $this->goUrl('/admin/tags');
    }

    public function saveTag(array $requestBody,  $id)
    {
        if ($id <> null){
            $tag = $this->Model->get('tags',$id);
        }else{
            $tag = $this->Model->create('tags');
        }
        $tag->title = $requestBody['title'];
        $tag->save();
    }

    public function showUpdateTagForm(ServerRequestInterface $request, array $arg): ResponseInterface
    {
        $tag = $this->getById('tags', $arg['id']);
        $target = 'tag-update/'.$arg['id'];
        $html = $this->View->showAddTagForm($tag, $target );
        return $this->responseWrapper($html);
    }


    public function updateTag(ServerRequestInterface $request, array $arg): ResponseInterface
    {
        $requestBody = $request->getParsedBody();
        $this->saveTag($requestBody, $arg['id']);
        $this->setMessage('Изменения выполнены успешно');
        return $this->goUrl('/admin/tags');
    }
}