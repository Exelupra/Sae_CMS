<?php

namespace minipress\core\actions;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use minipress\core\services\ArticleService;
use Slim\Routing\RouteContext;
use Slim\Exception\HttpBadRequestException;
use minipress\core\services\CsrfService;
use Exception;

class MakeArticleProcessAction extends AbstractAction {

    public function __invoke(Request $request, Response $response, array $args):Response{
        $post_data = $request->getParsedBody();
        var_dump($post_data['csrf']);

        $token = $post_data['csrf'] ?? null;
        try{
            CsrfService::check($token);
        } catch(Exception $e){
            throw new HttpBadRequestException($request, $e->getMessage());
        }

        $data = [
            'titre' => $post_data['titre'] ?? 
                throw new HttpBadRequestException($request, "titre manquant"),
            'resume' => $post_data['resume'] ??
                throw new HttpBadRequestException($request, "resume manquant"),
            'contenu' => $post_data['contenu'] ?? 
                throw new HttpBadRequestException($request, "contenu manquante"),
            'categorie' => $post_data['categorie'] ??
                throw new HttpBadRequestException($request, "categorie manquante"),
            'auteur' => $post_data['auteur'] ??
                throw new HttpBadRequestException($request, "auteur manquant"),
        ];

        $article = ArticleService::makeArticle($data);
        $routeParser = RouteContext::fromRequest($request)->getRouteParser();
        $url = $routeParser->urlFor('article');
        return $response->withHeader('Location',$url)->withStatus(302);
    }

}