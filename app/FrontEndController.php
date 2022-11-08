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

    public function index(ServerRequestInterface $request): ResponseInterface
    {
        //$articles = $this->Model->get('articles');
        //$articles = $articles->toString();

        $articles = $this->View->articleList();
       $response = new Response;
        $response->getBody()->write($articles);
        return $response;
    }
}