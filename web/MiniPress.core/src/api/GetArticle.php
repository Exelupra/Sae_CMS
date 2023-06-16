<?php

namespace minipress\core\api;

use minipress\core\actions\AbstractAction;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class GetArticle extends AbstractAction
{

    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $sort = $request->getQueryParams()['sort'];
        switch($sort){
            case 'date-asc':
                $article = \minipress\core\models\Article::orderBy('date', 'asc')->get();
                break;
            case 'date-desc':
                $article = \minipress\core\models\Article::orderBy('date', 'desc')->get();
                break;
            case 'auteur':
                $article = \minipress\core\models\Article::orderBy('auteur_id', 'asc')->get();
                break;
            default:
                $article = \minipress\core\models\Article::all();
                break;
        }
        $response->getBody()->write(json_encode($article));
        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    }
}