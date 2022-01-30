<?php

namespace Alura\Cursos\Controller;

use Alura\Cursos\Entity\Curso;
use Alura\Cursos\Helper\FlashMessageTrait;
use Doctrine\ORM\EntityManagerInterface;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class Persistencia implements RequestHandlerInterface
{
    use FlashMessageTrait;

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function handle(ServerRequestInterface $requisicao): ResponseInterface
    {
        $post = $requisicao->getParsedBody();
        $descricao = filter_var($post["descricao"]);

        if (array_key_exists("id-curso", $post)) {
            $id = filter_var($post["id-curso"], FILTER_VALIDATE_INT);
            $curso = $this->entityManager->find(Curso::class, $id);
            $mensagem = "Atualizado com sucesso";
        } else {
            $curso = new Curso();
            $mensagem = "Criado com sucesso";
        }
        
        $this->defineMensagem("success", $mensagem);

        $curso->setDescricao($descricao);

        $this->entityManager->persist($curso);
        $this->entityManager->flush();

        return new Response(200, ["Location" => "/listar-cursos"]);
    }
}
