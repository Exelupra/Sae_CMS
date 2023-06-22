<?php

namespace minipress\core\actions;

use http\Client\Request;
use http\Client\Response;
use minipress\core\services\CsrfService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Routing\RouteContext;
use Slim\Views\Twig;
use minipress\core\services\UtilisateurService;

class CreationUtilisateurAction extends AbstractAction{

    public function __invoke(Request|ServerRequestInterface $request, Response|ResponseInterface $response, array $args): ResponseInterface
    {
        $data = ['csrf' => CsrfService::generate()];
        $utilisateur = UtilisateurService::getUtilisateur();

        $twix = Twig::fromRequest($request);
        $mergedData = array_merge($data, $this->getGlobalTemplateVar($request));
        return $twix->render($response, 'inscription.twig', array_merge($mergedData));
    }
}