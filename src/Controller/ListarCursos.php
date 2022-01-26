<?php

namespace Alura\Cursos\Controller;

use Alura\Cursos\Entity\Curso;
use Alura\Cursos\Infra\EntityManagerCreator;
use Doctrine\Persistence\ObjectRepository;

class ListarCursos implements InterfaceControladorRequisicao
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
        require __DIR__ . "/../../view/cursos/listar-cursos.php";
    }
}
