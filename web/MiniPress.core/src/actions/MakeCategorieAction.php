<?php

namespace minipress\core\actions;

use minipress\core\services\CsrfService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use minipress\core\models\Categorie as Categorie;
use Slim\Views\Twig as Twig;

class MakeCategorieAction extends AbstractAction {

    public function __invoke(Request $request, Response $response, $args): Response {
        $data = [
            'csrf' => CsrfService::generate()
        ];

        $twig = Twig::fromRequest($request);
        return $twig->render($response, 'makeCategorie.twig', array_merge($data, $this->getGlobalTemplateVar($request)));
    }
}