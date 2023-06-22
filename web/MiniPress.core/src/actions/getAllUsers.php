<?php

namespace minipress\core\actions;

use minipress\core\services\CsrfService;
use minipress\core\services\UtilisateurService;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use Slim\Views\Twig;

class getAllUsers extends AbstractAction {

    public function __invoke(Request $request, Response $response, array $args): Response {

        $data= array_merge(['csrf' => CsrfService::generate()], $this->getGlobalTemplateVar($request));

        $users = UtilisateurService::getUtilisateur();
        $twig = Twig::fromRequest($request);
        return $twig->render($response, 'allUsers.twig', ['utilisateurs' => $users, 'data' => $data]);
    }

}