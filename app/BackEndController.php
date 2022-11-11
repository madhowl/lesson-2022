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
        if ($this->checkAuth()){
            return $this->showDashboard($request);

        }else{
            return $this->showSignInForm($request);
        }
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

    public function getById(string $tablename, int  $id)
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
                $this->signIn($user['username']);
                return $this->goUrl('/admin');
            }else{
                $r = $this->responseWrapper('Неверный пароль');
                dd($r);
            }
        }

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
            //dd("validation ok");
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

    public function showUserList()
    {
        $users = $this->getAll('users');
        //dd($this->Model->manager->listTableColumns('users'));
        $columns = ['username','email'];
        $html = $this->View->showUserList($users);
        return $this->responseWrapper($html);
    }

}