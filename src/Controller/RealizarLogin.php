<?php

namespace Alura\Cursos\Controller;

use Alura\Cursos\Entity\Usuario;
use Alura\Cursos\Infra\EntityManagerCreator;

class RealizarLogin implements InterfaceControladorRequisicao
{
    private $entityManager;
    private $usuarioRepo;

    public function __construct()
    {
        $this->entityManager = (new EntityManagerCreator())->getEntityManager();
        $this->usuarioRepo = $this->entityManager->getRepository(Usuario::class);
    }

    public function processaRequisicao(): void
    {
        $email = filter_input(
            INPUT_POST,
            "email",
            FILTER_VALIDATE_EMAIL
        );

        if (is_null($email) || $email === false) {
            echo "Email inválido";
            return;
        }

        // $senha = filter_input(
        //     INPUT_POST,
        //     "senha",
        //     FILTER_SANITIZE_STRING
        // );

        if (!array_key_exists("senha", $_POST)) {
            echo "Informe uma senha";
            return;
        }

        $senha = $_POST["senha"];

        if (is_null($senha) || $senha === false) {
            echo "Senha inválida";
            return;
        }

        /** @var Usuario */
        $usuario = $this->usuarioRepo->findOneBy(["email" => $email]);

        if(is_null($usuario) || !$usuario->senhaEstaCorreta($senha)) {
            echo "Email ou senha inválido";
            return;
        }

        header("Location: /listar-cursos");

    }
}
