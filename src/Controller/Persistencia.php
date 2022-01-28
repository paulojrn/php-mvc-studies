<?php

namespace Alura\Cursos\Controller;

use Alura\Cursos\Entity\Curso;
use Alura\Cursos\Helper\FlashMessageTrait;
use Alura\Cursos\Infra\EntityManagerCreator;

class Persistencia implements InterfaceControladorRequisicao
{
    use FlashMessageTrait;

    private $entityManager;

    public function __construct()
    {
        $this->entityManager = (new EntityManagerCreator)->getEntityManager();
    }

    public function processaRequisicao(): void
    {
        $descricao = $_POST["descricao"];

        if (array_key_exists("id-curso", $_POST)) {
            $id = $_POST["id-curso"];
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

        header("Location: /listar-cursos", false, 302);
    }
}
