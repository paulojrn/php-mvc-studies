<?php

namespace Alura\Cursos\Helper;

trait RenderizadorHtmlTrait
{
    public function renderizaHtml(string $caminhoTemplate, array $dados): string
    {
        extract($dados);
        ob_start(); // output buffer start
        require __DIR__ . "/../../view/$caminhoTemplate";
        $html = ob_get_clean();

        return $html;
    }
}
