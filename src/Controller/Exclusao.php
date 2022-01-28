<?php

namespace Alura\Cursos\Controller;

use Alura\Cursos\Infra\EntityManagerCreator;
use Doctrine\ORM\EntityManagerInterface;
use Alura\Cursos\Entity\Curso;
use Alura\Cursos\Helper\FlashMessageTrait;

class Exclusao implements InterfaceControladorRequisicao
{
    use FlashMessageTrait;

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct()
    {
        $this->entityManager = (new EntityManagerCreator)->getEntityManager();
    }

    public function processaRequisicao(): void
    {
        $id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

        if (is_null($id) || ($id === false)) {
            $this->defineMensagem("danger", "Cursos inexistente" );

            header("Location: /listar-cursos");
            return;
        }

        // $curso = $this->entityManager->getReference(Curso::class, $id);
        $curso = $this->entityManager->find(Curso::class, $id);
        $this->entityManager->remove($curso);
        $this->entityManager->flush();
        $this->defineMensagem("success", "Curso removido com sucesso" );

        header("Location: /listar-cursos");
    }
}
