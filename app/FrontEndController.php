<?php


namespace App;


use Laminas\Diactoros\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Scrawler\Arca\Database;

class FrontEndController
{
    private Database $Model;
    private  FrontEndView $View;
    private Response $Response;

    public function __construct( Database $Model, FrontEndView $View)
    {
        $this->Model = $Model;
        $this->View = $View;

    }

    public function responseWrapper(string $str):ResponseInterface
    {
        $response = new Response;
        $response->getBody()->write($str);
        return $response;

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

    public function index(ServerRequestInterface $request): ResponseInterface
    {
        $articles = $this->getAll('articles');
        $categories = $this->getAll('categories');
        $html = $this->View->articleList($articles, $categories);
        return $this->responseWrapper($html);
    }
    public function article(ServerRequestInterface $request, array $arg): ResponseInterface
    {
        $article = $this->getById('articles',$arg['id']);
        $categories = $this->getAll('categories');
        $html = $this->View->article($article, $categories);
        return $this->responseWrapper($html);
    }
}