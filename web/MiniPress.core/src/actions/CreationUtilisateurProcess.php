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
            'nom' => $post_data['nom'] ??
                throw new HttpBadRequestException($request, "nom manquant"),
            'prenom' => $post_data['prenom'] ??
                throw new HttpBadRequestException($request, "prenom manquant"),
            'pseudo' => $post_data['pseudo'] ??
                throw new HttpBadRequestException($request, "pseudo manquant"),
        ];


        UtilisateurService::createUtilisateur($data);
        $routeParser = RouteContext::fromRequest($request)->getRouteParser();
        $url = $routeParser->urlFor('home');
        return $response->withHeader('Location', $url)->withStatus(302);

    }
}
