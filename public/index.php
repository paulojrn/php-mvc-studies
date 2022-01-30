<?php

require __DIR__ . "/../vendor/autoload.php";

use Nyholm\Psr7\Factory\Psr17Factory;
use Nyholm\Psr7Server\ServerRequestCreator;
use Psr\Container\ContainerInterface;
use Psr\Http\Server\RequestHandlerInterface;

/**
 * @var ContainerInterface $container
 * @var RequestHandlerInterface $controlador
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

$psr17Factory = new Psr17Factory;

$creator = new ServerRequestCreator(
    $psr17Factory, // ServerRequestFactory
    $psr17Factory, // UriFactory
    $psr17Factory, // UploadedFileFactory
    $psr17Factory  // StreamFactory
);

$requisicao = $creator->fromGlobals();

$classeControladora = $rotas[$caminho];
$container = require __DIR__ . "/../configs/dependencies.php";
$controlador = $container->get($classeControladora);
$resposta = $controlador->handle($requisicao);

foreach ($resposta->getHeaders() as $name => $values) {
    foreach ($values as $value) {
        header(sprintf("%s: %s", $name, $value), false);
    }
}

echo $resposta->getBody();
