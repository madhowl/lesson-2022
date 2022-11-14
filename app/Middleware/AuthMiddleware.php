<?php
declare(strict_types=1);

namespace App\Middleware;

use App\Core\Auth;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Laminas\Diactoros\Response\RedirectResponse;

class AuthMiddleware implements MiddlewareInterface
{
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {

        if (isset($_SESSION['username'])) {
            return $handler->handle($request);
        }
        return new RedirectResponse('/signin');
    }
}