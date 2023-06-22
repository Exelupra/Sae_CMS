<?php

namespace minipress\core\actions;

use minipress\core\services\UtilisateurService;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use Slim\Routing\RouteContext;

class ToggleAdmin extends AbstractAction {

    public function __invoke(Request $request, Response $response, array $args): Response {
        $routeParser = RouteContext::fromRequest($request)->getRouteParser();
        $post_data = $request->getParsedBody();
        $user = UtilisateurService::toggleAdmin($post_data['id']);
        $url = $routeParser->urlFor('allUsers');
        return $response->withHeader('Location', $url)->withStatus(302);
    }

}