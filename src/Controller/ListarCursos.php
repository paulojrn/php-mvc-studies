<?php

namespace Alura\Cursos\Controller;

use Alura\Cursos\Entity\Curso;
use Alura\Cursos\Infra\EntityManagerCreator;
use Doctrine\Persistence\ObjectRepository;

class ListarCursos extends ControllerComHtml implements InterfaceControladorRequisicao
{
    private ObjectRepository $repositorioDeCursos;

    public function __construct()
    {
        $entityManager = (new EntityManagerCreator())->getEntityManager();
        $this->repositorioDeCursos = $entityManager->getRepository(Curso::class);
    }

    public function processaRequisicao(): void
    {
        $cursos = $this->repositorioDeCursos->findAll();
        $titulo = "Lista de cursos";

        echo $this->renderizaHtml("cursos/listar-cursos.php", [
            "cursos" => $cursos,
            "titulo" => $titulo
        ]);
    }
}
