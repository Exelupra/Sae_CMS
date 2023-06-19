<?php

namespace minipress\core\actions;

use minipress\core\services\CsrfService;
use minipress\core\services\UtilisateurService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Exception\HttpBadRequestException;
use Slim\Exception\HttpUnauthorizedException;
use Slim\Routing\RouteContext;

class ConnectUtilisateurProcess extends AbstractAction
{
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $post_data = $request->getParsedBody();

        $token = $post_data['csrf'] ?? null;

        CsrfService::check($token);


        $data = [
            'mail' => $post_data['mail'] ??
                throw new HttpBadRequestException($request, "mail manquant"),
            'mdp' => $post_data['mdp'] ??
                throw new HttpBadRequestException($request, "mdp manquant"),
        ];
        $mail = $data['mail'];
        $mdp = $data['mdp'];

        // Authentifier l'utilisateur
        $authService = new UtilisateurService(); // À remplacer par votre service d'authentification
       $user=$authService->authenticate($mail, $mdp);
       if (!$user) {
           $routeParser = RouteContext::fromRequest($request)->getRouteParser();
           $url = $routeParser->urlFor('connexion');
           return $response->withHeader('Location', $url)->withStatus(302);
       }else {

           //mettre user en json
           $userJson = json_encode($user);
           $_SESSION['user'] =$userJson;
           $routeParser = RouteContext::fromRequest($request)->getRouteParser();
           $url = $routeParser->urlFor('home');
           return $response->withHeader('Location', $url)->withStatus(302);


       }
    }
}
