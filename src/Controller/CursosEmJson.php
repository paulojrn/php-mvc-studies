<?php

namespace Alura\Cursos\Controller;

use Alura\Cursos\Entity\Curso;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\RequestHandlerInterface;

class CursosEmJson implements RequestHandlerInterface
{
    /**
     * @var ObjectRepository
     */
    private $repositorioDeCursos;

    public function __construct(EntityManagerInterface $em)
    {
        $this->repositorioDeCursos = $em->getRepository(Curso::class);
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $cursos = $this->repositorioDeCursos->findAll();
        return new Response(
            200, 
            ["Content-Type" => "application/json"],
            json_encode($cursos)
        );
    }
}
