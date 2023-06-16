<?php
namespace minipress\core\actions;
use minipress\core\models\Utilisateur;
use minipress\core\services\ArticleService;
use minipress\core\services\CsrfService;
use minipress\core\services\UtilisateurService;
use Slim\Exception\HttpBadRequestException;
use Slim\Routing\RouteContext;

class CreationUtilisateurProcess extends \minipress\core\actions\AbstractAction{

public function __invoke(\Psr\Http\Message\ServerRequestInterface $request, \Psr\Http\Message\ResponseInterface $response, array $args): \Psr\Http\Message\ResponseInterface
{
$post_data = $request->getParsedBody();

$token = $post_data['csrf'] ?? null;

CsrfService::check($token);



$data = [
 'id' => $post_data['csrf'] ??
throw new HttpBadRequestException($request, "id manquant"),
'mail' => $post_data['mail'] ??
throw new HttpBadRequestException($request, "mail manquant"),
'mdp' => $post_data['mdp'] ??
throw new HttpBadRequestException($request, "mdp manquant"),
];




$utilisateur = UtilisateurService::createUtilisateur($data['id'],$data['mail'], $data['mdp']);
        $routeParser = RouteContext::fromRequest($request)->getRouteParser();
        $url = $routeParser->urlFor('home');
        return $response->withHeader('Location',$url)->withStatus(302);

}
}
