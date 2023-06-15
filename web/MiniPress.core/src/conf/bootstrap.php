<?php
use Slim\Factory\AppFactory as AppFactory;
use Slim\Views\TwigMiddleware as TwigMiddleware;
use Slim\Views\Twig as Twig;
use minipress\core\services\Eloquent as Eloquent;
//use Supabase\Client as SupabaseClient;

$app = AppFactory::create();

$app->addRoutingMiddleware();
$app->addErrorMiddleware(true, false, false);

Eloquent::init(__DIR__.'/conf.ini');

$twig = Twig::create(__DIR__.'/../view', ['cache' => false]);

$app->add(TwigMiddleware::create($app, $twig));
echo "twig loaded\n";
// Créez une instance de SupabaseClient avec votre URL Supabase et votre clé d'API
/*$supabaseUrl = 'VOTRE_URL_SUPABASE';
$supabaseKey = 'VOTRE_CLE_API_SUPABASE';
$supabase = new SupabaseClient($supabaseUrl, $supabaseKey);

// Ajoutez l'instance de SupabaseClient à l'application Slim
$app->getContainer()->set(SupabaseClient::class, $supabase);*/

echo "bootstrap.php loaded\n";
return $app;
