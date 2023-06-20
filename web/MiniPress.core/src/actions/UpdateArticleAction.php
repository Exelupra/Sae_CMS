<?php

namespace minipress\core\actions;

use minipress\core\services\ArticleService;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use Slim\Routing\RouteContext;

class UpdateArticleAction extends AbstractAction {

    public function __invoke(Request $request , Response $response , array $args): Response{
        $post_data = $request->getParsedBody();

        $data = [
            'titre' => $post_data['titre'],
            'resume' => $post_data['resume'],
            'contenu' => $post_data['contenu'],
            'image' => $post_data['image'],
            'cat_id' => $post_data['cat_id'],
            'id' => $args['id']
        ];
    }

}