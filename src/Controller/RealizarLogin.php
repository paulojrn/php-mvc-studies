<?php

namespace Alura\Cursos\Controller;

use Alura\Cursos\Entity\Usuario;
use Alura\Cursos\Helper\FlashMessageTrait;
use Alura\Cursos\Infra\EntityManagerCreator;
use Doctrine\ORM\EntityManagerInterface;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class RealizarLogin implements RequestHandlerInterface
{
    use FlashMessageTrait;

    private $entityManager;
    private $usuarioRepo;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->usuarioRepo = $this->entityManager->getRepository(Usuario::class);
    }

    public function handle(ServerRequestInterface $requisicao): ResponseInterface
    {
        // $email = filter_input(
        //     INPUT_POST,
        //     "email",
        //     FILTER_VALIDATE_EMAIL
        // );

        $post = $requisicao->getParsedBody();
        $email = filter_var($post["email"], FILTER_VALIDATE_EMAIL);

        $respostaLogin = new Response(200, ["Location" => "/login"]);

        if (is_null($email) || $email === false) {
            $this->defineMensagem("danger", "Email digitado não é um email válido");
            
            return $respostaLogin;
        }

        $email = filter_var($post["email"]);

        if (!array_key_exists("senha", $_POST)) {
            $this->defineMensagem("danger", "Informe uma senha");

            return $respostaLogin;
        }

        $senha = $_POST["senha"];

        if (is_null($senha) || $senha === false) {
            $this->defineMensagem("danger", "Senha inválida");

            return $respostaLogin;
        }

        /** @var Usuario */
        $usuario = $this->usuarioRepo->findOneBy(["email" => $email]);

        if(is_null($usuario) || !$usuario->senhaEstaCorreta($senha)) {
            $this->defineMensagem("danger", "Email ou senha falsa");

            return $respostaLogin;
        }

        $_SESSION["logado"] = true;

        return new Response(200, ["Location" => "/listar-cursos"]);
    }
}
