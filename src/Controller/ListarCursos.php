<?php

namespace Alura\Cursos\Controller;

use Alura\Cursos\Entity\Curso;
use Alura\Cursos\Helper\RenderizadorHtmlTrait;
use Alura\Cursos\Infra\EntityManagerCreator;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class ListarCursos implements RequestHandlerInterface
{
    use RenderizadorHtmlTrait;
    
    private ObjectRepository $repositorioDeCursos;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $entityManager = $entityManager;
        $this->repositorioDeCursos = $entityManager->getRepository(Curso::class);
    }

    public function handle(ServerRequestInterface $requisicao): ResponseInterface
    {
        $cursos = $this->repositorioDeCursos->findAll();
        $titulo = "Lista de cursos";

        $html = $this->renderizaHtml("cursos/listar-cursos.php", [
            "cursos" => $cursos,
            "titulo" => $titulo
        ]);

        return new Response(200, [], $html);
    }
}
