<?php

namespace Alura\Cursos\Controller;

use Alura\Cursos\Entity\Curso;
use Alura\Cursos\Helper\RenderizadorHtmlTrait;
use Alura\Cursos\Infra\EntityManagerCreator;

class FormularioEdicao implements InterfaceControladorRequisicao
{
    use RenderizadorHtmlTrait;
    
    private $entityManager;

    public function __construct()
    {
        $this->entityManager = (new EntityManagerCreator())->getEntityManager();
    }

    public function processaRequisicao(): void
    {
        $id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

        if (is_null($id) || ($id === false)) {
            header("Location: /listar-cursos");
            return;
        }

        
        echo $this->renderizaHtml("cursos/formulario.php", [
            "curso" => $this->entityManager->find(Curso::class, $id),
            "titulo" => "Alterar curso"
        ]);
    }
}
