<?php

namespace minipress\core\actions;

use minipress\core\services\ArticleService;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use Slim\Views\Twig;

class getAllArticlesAction extends AbstractAction {

    public function __invoke(Request $request , Response $response , array $args): Response{
                $articles = ArticleService::getAllArticle();
                $routeContext = \Slim\Routing\RouteContext::fromRequest($request);
                $routeParser = \Slim\Routing\RouteContext::fromRequest($request)->getRouteParser();
                $twig = Twig::fromRequest($request);
                return $twig->render($response, 'allArticle.twig', ['articles' => $articles] );
    }

}