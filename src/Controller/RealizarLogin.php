<?php

namespace Alura\Cursos\Controller;

use Alura\Cursos\Entity\Usuario;
use Alura\Cursos\Helper\FlashMessageTrait;
use Alura\Cursos\Infra\EntityManagerCreator;

class RealizarLogin implements InterfaceControladorRequisicao
{
    use FlashMessageTrait;

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
            $this->defineMensagem("danger", "Email digitado não é um email válido");

            header("Location: /login");
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
            $this->defineMensagem("danger", "Email ou senha falsa");

            header("Location: /login");
            return;
        }

        $_SESSION["logado"] = true;

        header("Location: /listar-cursos");

    }
}
