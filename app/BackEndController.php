<?php
declare(strict_types=1);


namespace App;


use App\Core\Auth;
use App\Core\ModelInterface;

use Laminas\Diactoros\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Scrawler\Arca\Database;

class BackEndController
{
use Auth;

    private  BackEndView $View;
    private  Database $Mode;

    public function __construct(Database $Model, BackEndView $View)
    {
        $this->View = $View;
        $this->Mode = $Model;

    }
    public function responseWrapper(string $str):ResponseInterface
    {
        $response = new Response;
        $response->getBody()->write($str);
        return $response;

    }
    public function index(ServerRequestInterface $request): ResponseInterface
    {
        if ($this->checkAuth()){
            return $this->showDashboard($request);

        }else{
            return $this->showSignInForm($request);
        }
    }

    public function showDashboard(ServerRequestInterface $request): ResponseInterface
    {
        $html = $this->View->index();
//        $response = new Response;
//        $response->getBody()->write($html);
//        return $response;
        return $this->responseWrapper($html);
    }

    public function showSignInForm(ServerRequestInterface $request): ResponseInterface
    {
        $html =$this->View->showSignInForm();
//        $response = new Response;
//        $response->getBody()->write($html);
//        return $response;
        return $this->responseWrapper($html);
    }

    public function showSignUpForm(ServerRequestInterface $request): ResponseInterface
    {
        $html = $this->View->showSignUpForm();
//        $response = new Response;
//        $response->getBody()->write($html);
//        return $response;
        return $this->responseWrapper($html);
    }

}