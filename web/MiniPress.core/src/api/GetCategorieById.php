<?php

namespace minipress\core\api;

use minipress\core\actions\AbstractAction;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class GetCategorieById extends AbstractAction
{

    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $categorie = \minipress\core\models\Categorie::find($args['id']);
        $response->getBody()->write(json_encode($categorie));
        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    }
}