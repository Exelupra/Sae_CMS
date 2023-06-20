<?php

namespace minipress\core\actions;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class GetJs extends AbstractAction
{

    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $filePath = __DIR__ . '/../../../MiniPress.web/' . $args['path'];
        if (file_exists($filePath)) {
            $content = file_get_contents($filePath);
            $response->getBody()->write($content);
            $response = $response->withHeader('Content-Type', 'application/javascript');
            return $response;
        } else {
            $response->getBody()->write('Fichier HTML introuvable');
            return $response->withStatus(404);
        }
    }
}