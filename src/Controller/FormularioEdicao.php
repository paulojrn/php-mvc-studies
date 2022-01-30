<?php

namespace Alura\Cursos\Controller;

use Alura\Cursos\Entity\Curso;
use Alura\Cursos\Helper\RenderizadorHtmlTrait;
use Doctrine\ORM\EntityManagerInterface;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class FormularioEdicao implements RequestHandlerInterface
{
    use RenderizadorHtmlTrait;
    
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

        if (is_null($id) || ($id === false)) {
            return new Response(200, ["Location" => "/listar-cursos"]);
        }
        
        $html = $this->renderizaHtml("cursos/formulario.php", [
            "curso" => $this->entityManager->find(Curso::class, $id),
            "titulo" => "Alterar curso"
        ]);

        return new Response(200, [], $html);
    }
}
