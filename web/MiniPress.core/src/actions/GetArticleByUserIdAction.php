<?php

namespace minipress\core\actions;

use minipress\core\services\ArticleService;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use Slim\Views\Twig;

class GetArticleByUserIdAction extends AbstractAction {

    public function __invoke(Request $request , Response $response , array $args): Response{
        return $response;
    }

}