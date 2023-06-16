<?php

namespace minipress\core\actions;

use minipress\core\services\CsrfService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;
use minipress\core\services\CategorieService;
use minipress\core\services\UtilisateurService;

class MakeArticleAction extends AbstractAction {

    public function __invoke(Request $request, Response $response, array $args): Response {
        $data = [
            'csrf' => CsrfService::generate()
        ];

        $categories = CategorieService::getAllCategories();
        $users = UtilisateurService::getUtilisateur();

        $view = Twig::fromRequest($request);
        array_merge($data, $this->getGlobalTemplateVar($request));
        return $view->render($response, 'makeArticle.twig', [
            'data' => $data,
            'categories' => $categories,
            'users' => $users
        ]);

    }

}