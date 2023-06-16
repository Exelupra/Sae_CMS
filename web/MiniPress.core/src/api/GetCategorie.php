<?php

namespace minipress\core\api;

use minipress\core\actions\AbstractAction;

class GetCategorie extends AbstractAction
{

    public function __invoke(\Psr\Http\Message\ServerRequestInterface $request, \Psr\Http\Message\ResponseInterface $response, $args): \Psr\Http\Message\ResponseInterface
    {
        $categorie = \minipress\core\models\Categorie::all();
        $response->getBody()->write(json_encode($categorie));
        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    }
}