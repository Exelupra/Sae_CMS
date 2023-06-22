<?php

namespace minipress\core\api;

use minipress\core\actions\AbstractAction;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class GetArticleByCategorie extends AbstractAction
{

    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $article = \minipress\core\models\Categorie::find($args['id_categ'])->articles;
        $response->getBody()->write(json_encode($article));
        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    }
}