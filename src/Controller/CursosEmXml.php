<?php

namespace Alura\Cursos\Controller;

use Alura\Cursos\Entity\Curso;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\RequestHandlerInterface;
use SimpleXMLElement;

class CursosEmXml implements RequestHandlerInterface
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
        /**
         * @var Curso[] $cursos
         */

        $cursos = $this->repositorioDeCursos->findAll();
        $cursosEmXml = new SimpleXMLElement("<cursos/>");

        foreach ($cursos as $curso) {
            $cursoEmXml = $cursosEmXml->addChild("curso");
            $cursoEmXml->addChild("id", $curso->getId());
            $cursoEmXml->addChild("descricao", $curso->getDescricao()); 
        }

        return new Response(
            200,
            ["Content-Type" => "application/xml"],
            $cursosEmXml->asXML()
        );
    }
}
