<?php

namespace minipress\core\actions;

use minipress\core\services\ArticleService;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use Slim\Views\Twig;

class getMyArticlesAction extends AbstractAction {

    public function __invoke(Request $request , Response $response , array $args): Response{
                $published = ArticleService::getPublishedByUser(json_decode($_SESSION['user']));
                $unpublished = ArticleService::getUnpublishedByUser(json_decode($_SESSION['user']));
                
                $twig = Twig::fromRequest($request);
                return $twig->render($response, 'articleByUser.twig', 
                ['published' => $published, 'unpublished' => $unpublished] );
    }

}