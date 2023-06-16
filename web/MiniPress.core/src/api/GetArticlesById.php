<?php

namespace MiniPress\core\api;

use minipress\core\actions\AbstractAction;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class GetArticlesById extends AbstractAction
{

    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $article = \MiniPress\core\models\Article::find($args['id']);
        $response->getBody()->write(json_encode($article));
        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    }
}