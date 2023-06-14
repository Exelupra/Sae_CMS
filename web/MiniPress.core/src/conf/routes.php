<?php

    use Slim\Views\Twig;
    use \minipress\core\actions\MakeArticleAction;

    return function($app) {

        $app->get('/article/create[/]', MakeArticleAction::class)->setName('makeArticle');

    };