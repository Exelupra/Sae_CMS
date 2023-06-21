<?php

namespace minipress\core\api;

use minipress\core\actions\AbstractAction;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class GetArticleByAuteur extends AbstractAction
{

    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $id = $args['id'];
        $articles = \minipress\core\models\Article::where('auteur', $id)->get();
        $output = [
            "data" => $articles
        ];
        $response->getBody()->write(json_encode($output));
        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    }
}