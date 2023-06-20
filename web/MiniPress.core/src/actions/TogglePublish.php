<?php

namespace minipress\core\actions;

use minipress\core\services\ArticleService;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use Slim\Routing\RouteContext;

class TogglePublish extends AbstractAction {

    public function __invoke(Request $request , Response $response , array $args): Response{
        $post_data = $request->getParsedBody();
        var_dump(isset($args['id']));
        $routeParser = RouteContext::fromRequest($request)->getRouteParser();
        if(isset($args['id'])){
            ArticleService::togglePublish($args['id']);
            $url = $routeParser->urlFor('articleById', ['id' => $args['id']]);
        } else if(isset($post_data['id'])){
            ArticleService::togglePublish($post_data['id']);
            $url = $routeParser->urlFor('articleByUser');
        }

        return $response->withHeader('Location', $url)->withStatus(302);
    }

}