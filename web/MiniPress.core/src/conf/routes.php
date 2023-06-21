<?php

use minipress\core\actions\ConnectUtilisateur;
use minipress\core\actions\DisconnectUtilisateurAction;
use minipress\core\api\GetArticle;
use minipress\core\api\GetArticleByAuteur;
use minipress\core\api\GetArticleByCategorie;
use minipress\core\api\GetArticlesById;
use minipress\core\api\GetCategorie;
use minipress\core\api\GetCategorieById;
use Slim\Views\Twig;
    use Psr\Http\Message\ResponseInterface as Response;
    use Psr\Http\Message\ServerRequestInterface as Request;
    use \minipress\core\actions\MakeArticleAction;
    use \minipress\core\actions\MakeArticleProcessAction;
    use \minipress\core\actions\getAllArticlesAction;
    use \minipress\core\actions\MakeCategorieAction;
    use \minipress\core\actions\MakeCategorieProcessAction;
    use \minipress\core\actions\CreationUtilisateurAction;
    use \minipress\core\actions\CreationUtilisateurProcess;
    use \minipress\core\actions\ConnectUtilisateurProcess;
    use \minipress\core\actions\getUnpublishedArticlesAction;
    use \minipress\core\actions\PublishArticleAction;
    use \minipress\core\actions\PublishArticleProcessAction;
    use \minipress\core\actions\GetArticleByIdAction;
    use \minipress\core\actions\GetArticleByUserIdAction;
    use \minipress\core\actions\getMyArticlesAction;
    use \minipress\core\actions\TogglePublish;
    use \minipress\core\actions\DeleteArticle;
    use \minipress\core\actions\DeconnectUtilisateurProcess;
    use \minipress\core\actions\getUnpublishedArticlesProcessAction;
    use \minipress\core\actions\GetJsHtml;
    use \minipress\core\actions\GetJs;
    use \minipress\core\services\UtilisateurService;


    return function($app) {

        $app->get('[/]',function (Request $request, Response $response, $args) {

            $user = json_decode($_SESSION['user']);
            $user = json_decode($_SESSION['user']);
            $twig = Twig::fromRequest($request);
            if($user != null){
                return $twig->render($response, 'home.twig', ['user' => $user]);
            }
            return $twig->render($response, 'home.twig');
        })->setName('home');

        $app->get('/article', getAllArticlesAction::class)->setName('article');
        $app->get('/article/{id:\d+}[/]', GetArticleByIdAction::class)->setName('articleById');

        $app->get('/myarticles[/]', getMyArticlesAction::class)->setName('articleByUser');
        $app->post('/myarticles[/]', TogglePublish::class)->setName('togglePublish');

        $app->get('/myarticles/{id:[a-zA-Z0-9]+}[/]', GetArticleByUserIdAction::class)->setName('myArticleById');
        $app->post('/myarticles/{id:[a-zA-Z0-9]+}[/]', TogglePublish::class)->setName('togglePublishFromId');
        $app->get('/article/{id:\d+}[/]', GetArticlesByIdAction::class)->setName('articleById');

        $app->get('/article/create[/]', MakeArticleAction::class)->setName('makeArticle');
        $app->post('/article/create[/]', MakeArticleProcessAction::class)->setName('madeArticle');

        $app->post('/article/{id:[a-zA-Z0-9]+}/delete', DeleteArticle::class)->setName('deleteArticle');

        $app->get('/article/unpublished[/]', getUnpublishedArticlesAction::class)->setName('unpublished');

        $app->get('/article/{id}/pusblish[/]', PublishArticleAction::class)->setName('publishArticle');
        $app->post('/article/{id}/pusblish[/]', PublishArticleProcessAction::class)->setName('publishedArticle');

        $app->get('/article/unpublished[/]', getUnpublishedArticlesAction::class)->setName('unpublished');

        $app->get('/article/{id}/pusblish[/]', PublishArticleAction::class)->setName('publishArticle');
        $app->post('/article/{id}/pusblish[/]', PublishArticleProcessAction::class)->setName('publishedArticle');

        $app->get('/categorie/create[/]', MakeCategorieAction::class)->setName('makeCategorie');
        $app->post('/categorie/create[/]', MakeCategorieProcessAction::class)->setName('madeCategorie');

        $app->get('/api/categories[/]', GetCategorie::class)->setName('categorie');
        $app->get('/api/articles[/]', GetArticle::class)->setName('article');
        $app->get('/api/categories/{id_categ}/articles', GetArticleByCategorie::class)->setName('articleByCategorie');
        $app->get('/api/articles/{id}', GetArticlesById::class)->setName('articleById');
        $app->get('/api/auteurs/{id}/articles', GetArticleByAuteur::class)->setName('articleByAuteur');
        $app->get('/api/categorie/{id}', GetCategorieById::class)->setName('categorieById');

        $app->get('/inscription',CreationUtilisateurAction::class)->setName('inscription');
        $app->post('/inscription',CreationUtilisateurProcess::class)->setName('inscriptionProcess');

        $app->get('/connexion', ConnectUtilisateur::class)->setName('connexion');
        $app->post('/connexion', ConnectUtilisateurProcess::class)->setName('connexionProcess');

        $app->get('/deconnexion', DisconnectUtilisateurAction::class)->setName('deconnexion');
        $app->post('/deconnexion', DisconnectUtilisateurAction::class)->setName('deconnexion');

        $app->get('/js/{path:.+}', GetJs::class)->setName('js');
        $app->get('/jsHtml', GetJsHtml::class)->setName('js');
    };