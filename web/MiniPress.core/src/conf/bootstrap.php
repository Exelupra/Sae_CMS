<?php

    use Slim\Factory\AppFactory as AppFactory;
    use Slim\Views\TwigMiddleware as TwigMiddleware;
    use Slim\Views\Twig as Twig;
    use minipress\core\services\Eloquent as Eloquent;


    $app = AppFactory::create();

    $app->addRoutingMiddleware();
    $app->addErrorMiddleware(true, false, false);

    //Eloquent::init(__DIR__.'/../conf.ini');

    $twig = Twig::create(__DIR__.'/../view', ['cache' => false]);

    $app->add(TwigMiddleware::create($app, $twig));

    return $app;
