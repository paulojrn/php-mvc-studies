<?php

namespace Alura\Cursos\Controller;

use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class Deslogar implements RequestHandlerInterface
{
    public function handle(ServerRequestInterface $requisicao): ResponseInterface
    {
        session_destroy();
        return new Response(200, ["Location" => "/login"]);
    }
}