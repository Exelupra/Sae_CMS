<?php

namespace minipress\core\actions;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class GetJsHtml extends AbstractAction
{

    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $filePath = __DIR__ . '/../../../web/' . $args['file'];

        if (file_exists($filePath)) {
            $content = file_get_contents($filePath);
            $response->getBody()->write($content);
            return $response;
        } else {
            $response->getBody()->write('Fichier introuvable');
            return $response->withStatus(404);
        }
    }
}