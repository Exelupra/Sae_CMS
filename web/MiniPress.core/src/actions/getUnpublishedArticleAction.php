<?php

namespace minipress\core\actions;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use minipress\core\services\ArticleService;
use Slim\Views\Twig;

class getUnpublishedArticlesAction extends AbstractAction {

    public function __invoke(Request $request, Response $response, array $args):Response{
        $articles = ArticleService::getUnpublished();
        $Twig = Twig::fromRequest($request);
        return $Twig->render($response, 'unpublished.twig', ['articles' => $articles]);
    }

}