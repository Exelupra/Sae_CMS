<?php

namespace minipress\core\actions;

use http\Client\Request;
use http\Client\Response;
use minipress\core\services\CsrfService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\Twig;

class ConnectUtilisateur extends AbstractAction{

    public function __invoke(Request|ServerRequestInterface $request, Response|ResponseInterface $response, array $args): ResponseInterface
    {
        $data = ['csrf' => CsrfService::generate()];

        $twix = Twig::fromRequest($request);
        $mergedData = array_merge($data, $this->getGlobalTemplateVar($request));
        return $twix->render($response, "authentification.twig", array_merge($mergedData));
    }
}