<?php

namespace minipress\core\actions;

//kestufé
use minipress\core\services\CategorieService;
use minipress\core\services\CsrfService;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use Slim\Views\Twig;

class getAllCategories extends AbstractAction {

    public function __invoke(Request $request , Response $response , array $args): Response{
                $categories = CategorieService::getAllCategories();
                $data = array_merge(['csrf' => CsrfService::generate()], $this->getGlobalTemplateVar($request));
                $routeContext = \Slim\Routing\RouteContext::fromRequest($request);
                $routeParser = \Slim\Routing\RouteContext::fromRequest($request)->getRouteParser();
                $twig = Twig::fromRequest($request);
                return $twig->render($response, 'allCategories.twig', 
                ['categories' => $categories, 'data' => $data]);
    }

}