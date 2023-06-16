<?php

namespace minipress\core\actions;

use minipress\core\services\CsrfService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use minipress\core\services\CategorieService;
use Exception;
use Slim\Exception\HttpBadRequestException;
use Slim\Routing\RouteContext;

class MakeCategorieProcessAction extends AbstractAction {

    public function __invoke(Request $request, Response $response, $args): Response {
        
        $post_data = $request->getParsedBody();

        $token = $post_data['csrf'] ?? null;
        try{
            CsrfService::check($token);
        } catch(Exception $e){
            throw new HttpBadRequestException($request, $e->getMessage());
        }

        $data = [
            'libelle' => $post_data['libelle'] ?? 
                throw new HttpBadRequestException($request, "libelle manquant"),
            'description' => $post_data['description'] ??
                throw new HttpBadRequestException($request, "description manquante")
        ];

        $categorie = CategorieService::makeCategorie($data);
        $routeParser = RouteContext::fromRequest($request)->getRouteParser();
        $url = $routeParser->urlFor('makeArticle');
        return $response->withHeader('Location',$url)->withStatus(302);

    }
}