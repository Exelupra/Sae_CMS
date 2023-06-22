<?php

namespace minipress\core\actions;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class GetJs extends AbstractAction
{
    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $filePath = __DIR__ . '/../../../web/' . $args['path'];
        if (file_exists($filePath)) {
            $content = file_get_contents($filePath);

            $extension = pathinfo($filePath, PATHINFO_EXTENSION);
            $contentType = $this->getContentType($extension);

            if ($contentType !== null) {
                $response = $response->withHeader('Content-Type', $contentType);
                $response->getBody()->write($content);
                return $response;
            }
        }

        $response->getBody()->write('Fichier introuvable');
        return $response->withStatus(404);
    }

    private function getContentType(string $extension): ?string
    {
        $contentTypes = [
            'js' => 'application/javascript',
            'css' => 'text/css',
        ];

        return $contentTypes[$extension] ?? null;
    }
}
