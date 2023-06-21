<?php

namespace minipress\core\actions;

use minipress\core\services\CategorieService;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use Slim\Routing\RouteContext;


class DeleteCategorieAction extends AbstractAction {

    public function __invoke(Request $request , Response $response , array $args): Response{
        $id = $args['id'];
        CategorieService::deleteCategorie($id);
        $routeParser = RouteContext::fromRequest($request)->getRouteParser();
        $url = $routeParser->urlFor('allCategorie');
        return $response->withHeader('Location', $url)->withStatus(302);
        
    }

}