<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class ErrorController extends AbstractController
{
    #[Route('/error/{code}', name: 'app_error')]
    public function show(int $code, Request $request): Response
    {
        // Utilise des chemins relatifs à "templates/"
        $template = match ($code) {
            404, 403 => 'error/No-page.html.twig',
            500      => 'error/No-server.html.twig',
            default  => 'error/No-page.html.twig',
        };

        return $this->render($template, [
            'code' => $code,
            'path' => $request->getPathInfo(),
        ]);
    }
}