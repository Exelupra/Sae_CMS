<?php

namespace minipress\core\actions;

use minipress\core\services\CsrfService;
use minipress\core\services\UtilisateurService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Exception\HttpBadRequestException;
use Slim\Routing\RouteContext;

class CreationUtilisateurProcess extends AbstractAction
{

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $post_data = $request->getParsedBody();

        $token = $post_data['csrf'] ?? null;

        CsrfService::check($token);


        $data = [
            'id' => $post_data['csrf'] ??
                throw new HttpBadRequestException($request, "id manquant"),
            'mail' => $post_data['mail'] ??
                throw new HttpBadRequestException($request, "mail manquant"),
            'mdp' => $post_data['mdp'] ??
                throw new HttpBadRequestException($request, "mdp manquant"),
        ];


        UtilisateurService::createUtilisateur($data['id'], $data['mail'], $data['mdp']);
        $routeParser = RouteContext::fromRequest($request)->getRouteParser();
        $url = $routeParser->urlFor('home');
        return $response->withHeader('Location', $url)->withStatus(302);

    }
}
