<?php

require __DIR__ . "/../vendor/autoload.php";

use Alura\Cursos\Controller\InterfaceControladorRequisicao;

/**
 * @var InterfaceControladorRequisicao $controlador
 */

$rotas = require __DIR__ . "/../configs/routes.php";
$caminho = "/listar-cursos";


if (array_key_exists("PATH_INFO", $_SERVER)) {
    $caminho = $_SERVER["PATH_INFO"];
    
    if (!array_key_exists($caminho, $rotas)) {
        http_response_code(404);
        exit();
    }
}

session_start();

if (!array_key_exists("logado", $_SESSION) && $caminho !== "/login" && $caminho !== "/realiza-login") {
    header("Location: /login");
    exit();
}

$classeControladora = $rotas[$caminho];
$controlador = new $classeControladora();
$controlador->processaRequisicao();
