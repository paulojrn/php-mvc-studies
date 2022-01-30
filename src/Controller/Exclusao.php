<?php

namespace Alura\Cursos\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Alura\Cursos\Entity\Curso;
use Alura\Cursos\Helper\FlashMessageTrait;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class Exclusao implements RequestHandlerInterface
{
    use FlashMessageTrait;

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function handle(ServerRequestInterface $requisicao): ResponseInterface
    {

        // $id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

        $get = $requisicao->getQueryParams();
        $id = filter_var($get["id"], FILTER_VALIDATE_INT);
        
        $resposta = new Response(302, ["Location" => "/listar-cursos"]);

        if (is_null($id) || ($id === false)) {
            $this->defineMensagem("danger", "Cursos inexistente" );

            return $resposta;
        }

        // $curso = $this->entityManager->getReference(Curso::class, $id);
        $curso = $this->entityManager->find(Curso::class, $id);
        $this->entityManager->remove($curso);
        $this->entityManager->flush();
        $this->defineMensagem("success", "Curso removido com sucesso" );

        return $resposta;
    }
}
