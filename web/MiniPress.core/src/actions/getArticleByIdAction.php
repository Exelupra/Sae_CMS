<?php

namespace minipress\core\actions;

use minipress\core\services\CategorieService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use minipress\core\services\ArticleService;
use minipress\core\services\UtilisateurService;
use Slim\Views\Twig;

class getArticleByIdAction extends AbstractAction {

    public function __invoke(Request $request, Response $response, array $args):Response{
        $article = ArticleService::getArticleById($args['id']);
        $user = UtilisateurService::getUtilisateurById($article->auteur);
        $categorie = CategorieService::getAllCategories();
        $twig = Twig::fromRequest($request);
        return $twig->render($response, 'article.twig', ['article' => $article, 
            'auteur' => $user, 'categories' => $categorie]);
    }

}