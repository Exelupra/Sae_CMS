<?php

namespace minipress\core\actions;

use minipress\core\services\CategorieService;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use Slim\Routing\RouteContext;

class updateCategorieAction extends AbstractAction {

    public function __invoke(Request $request , Response $response , array $args): Response{
        $post_data = $request->getParsedBody();

        $data = [
            'libelle' => $post_data['libelle'],
            'description' => $post_data['description'],
            'id' => $args['id']
        ];

        CategorieService::updateCategorie($data);
        $routeParser = RouteContext::fromRequest($request)->getRouteParser();
        $url = $routeParser->urlFor('allCategorie', ['id' => $args['id']]);
        return $response->withHeader('Location', $url)->withStatus(302);
    }

}