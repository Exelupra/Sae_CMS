<?php

namespace minipress\core\actions;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class GetJsHtml extends AbstractAction
{

    public function __invoke(Request $request, Response $response, array $args): Response
    {
        return $response->withHeader('Location', '/../../../MiniPress.web/ListeArticle.html')->withStatus(200);
    }
}