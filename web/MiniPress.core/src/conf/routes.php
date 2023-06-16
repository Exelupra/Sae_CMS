<?php

    use Slim\Views\Twig;
    use Psr\Http\Message\ResponseInterface as Response;
    use Psr\Http\Message\ServerRequestInterface as Request;
    use \minipress\core\actions\MakeArticleAction;
    use \minipress\core\actions\MakeArticleProcessAction;
    use \minipress\core\actions\getAllArticlesAction;
    use \minipress\core\actions\MakeCategorieAction;
    use \minipress\core\actions\MakeCategorieProcessAction;
    

    return function($app) {

        $app->get('/',function (Request $request, Response $response, $args) {
            $twig = Twig::fromRequest($request);
            return $twig->render($response, 'home.twig', $args);
        })->setName('home');

        $app->get('/article', getAllArticlesAction::class)->setName('article');

        $app->get('/article/create[/]', MakeArticleAction::class)->setName('makeArticle');
        $app->post('/article/create[/]', MakeArticleProcessAction::class)->setName('madeArticle');

<<<<<<< HEAD
        $app->get('/categorie/create[/]', MakeCategorieAction::class)->setName('makeCategorie');
        $app->post('/categorie/create[/]', MakeCategorieProcessAction::class)->setName('madeCategorie');

=======
        $app->get('/api/categories[/]',\MiniPress\core\api\GetCategorie::class)->setName('categorie');
        $app->get('/api/articles[/]',\MiniPress\core\api\GetArticle::class)->setName('article');
        $app->get('/api/categories/{id_categ}/articles',\MiniPress\core\api\GetArticleByCategorie::class)->setName('articleByCategorie');
        $app->get('/api/articles/{id}',\MiniPress\core\api\GetArticlesById::class)->setName('articleById');
        $app->get('/api/auteurs/{id}/articles',\MiniPress\core\api\GetArticleByAuteur::class)->setName('articleByAuteur');
>>>>>>> dc7438f578787b7448bb803da4caa93eda742a8a
    };