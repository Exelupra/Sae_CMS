<?php

namespace minipress\core\api;

use minipress\core\actions\AbstractAction;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class GetArticle extends AbstractAction
{

    public function __invoke(Request $request, Response $response, array $args): Response
    {
        try {
            $sort = $request->getQueryParams()['sort'] ?? null;
            switch ($sort) {
                case 'date-asc':
                    $article = \minipress\core\models\Article::whereNotNull('date_de_publication')->orderBy('date_de_publication', 'asc')->get();
                    break;
                case 'date-desc':
                    $article = \minipress\core\models\Article::whereNotNull('date_de_publication')->orderBy('date_de_publication', 'desc')->get();
                    break;
                case 'dateC-asc':
                    $article = \minipress\core\models\Article::whereNotNull('date_de_creation','date_de_publication')->orderBy('date_de_creation', 'asc')->get();
                    break;
                case 'dateC-desc':
                    $article = \minipress\core\models\Article::whereNotNull('date_de_creation','date_de_publication')->orderBy('date_de_creation', 'desc')->get();
                    break;
                case 'auteur':
                    $article = \minipress\core\models\Article::whereNotNull('date_de_publication')->orderBy('auteur', 'asc')->get();
                    break;
                default:
                    $article = \minipress\core\models\Article::whereNotNull('date_de_publication')->get();
                    break;
            }
        } catch (\Exception $e) {
            $article = \minipress\core\models\Article::whereNotNull('date_de_publication')->get();
        }
        $response->getBody()->write(json_encode($article));
        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    }
}