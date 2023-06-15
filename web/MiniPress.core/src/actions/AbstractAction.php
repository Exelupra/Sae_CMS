<?php

namespace minipress\core\actions;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Routing\RouteContext;

abstract class AbstractAction {
    abstract public function __invoke(Request $request, Response $response, array $args): Response;

    protected function getGlobalTemplateVar(Request $request): array {
        
        $routeContext = RouteContext::fromRequest($request)->getRouteParser();

        $output = [
            "globals" => [
                'css_dir' => 'css',
                'imd_dir' => 'img',
                'menu' => [
                    ['url' => '#', 'libelle' => 'signin'],
                    ['url' => '#', 'libelle' => 'register']
                ]
            ]
        ];
        return $output;
    }
}