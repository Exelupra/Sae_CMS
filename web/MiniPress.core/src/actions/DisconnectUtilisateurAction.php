<?php

namespace minipress\core\actions;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Routing\RouteContext;

class DisconnectUtilisateurAction extends AbstractAction {

    //uwu

    public function __invoke(Request $request, Response $response, array $args): Response
    {
        session_destroy();
        $routeParser = RouteContext::fromRequest($request)->getRouteParser();
        $url = $routeParser->urlFor('home');
        return $response->withHeader('Location', $url)->withStatus(302);
    }
}