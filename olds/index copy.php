<?php

$pathInfo = "listar-cursos";

if (array_key_exists("PATH_INFO", $_SERVER)) {
    $pathInfo = str_replace("/", "", $_SERVER["PATH_INFO"]);
}

$routeList = ["listar-cursos", "novo-curso"];
$selectedRoute = "";

if(!in_array($pathInfo, $routeList, true)) {
    var_dump("Erro ao informar URL!");
    exit();
}

require "$pathInfo.php";