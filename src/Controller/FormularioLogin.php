<?php

namespace Alura\Cursos\Controller;

use Alura\Cursos\Helper\RenderizadorHtmlTrait;

class FormularioLogin implements InterfaceControladorRequisicao
{
    use RenderizadorHtmlTrait;
    
    public function processaRequisicao(): void
    {
        echo $this->renderizaHtml("login/formulario.php", [
            "titulo" => "Login"
        ]);
    }
}