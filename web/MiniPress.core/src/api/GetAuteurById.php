<?php

namespace minipress\core\api;

use minipress\core\actions\AbstractAction;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class GetAuteurById extends AbstractAction
{

    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $auteur = \minipress\core\models\Auteur::select('pseudo')->where('id', '=', $args['id'])->get();
        $response->getBody()->write(json_encode($auteur));
        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    }
}