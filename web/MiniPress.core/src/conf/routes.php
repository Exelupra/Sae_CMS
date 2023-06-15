<?php

    use Slim\Views\Twig;
    use Psr\Http\Message\ResponseInterface as Response;
    use Psr\Http\Message\ServerRequestInterface as Request;
    use \minipress\core\actions\MakeArticleAction;
    use \minipress\core\actions\MakeArticleProcessAction;
    use \minipress\core\actions\getAllArticlesAction;

    return function($app) {

        $app->get('/',function (Request $request, Response $response, $args) {
            $response->getBody()->write('Hello World');
            return $response;
        })->setName('home');

        $app->get('/article', getAllArticlesAction::class)->setName('article');

        $app->get('/article/create[/]', MakeArticleAction::class)->setName('makeArticle');
        $app->post('/article/create[/]', MakeArticleProcessAction::class)->setName('madeArticle');

        $app->get('/api/categories[/]',\MiniPress\core\api\GetCategorie::class)->setName('categorie');
        $app->get('/api/articles[/]',\MiniPress\core\api\GetArticle::class)->setName('article');
        $app->get('/api/categories/{id_categ}/articles',\MiniPress\core\api\GetArticleByCategorie::class)->setName('articleByCategorie');
        $app->get('/api/articles/{id}',\MiniPress\core\api\GetArticlesById::class)->setName('articleById');
        $app->get('/api/auteurs/{id}/articles',\MiniPress\core\api\GetArticleByAuteur::class)->setName('articleByAuteur');
    };