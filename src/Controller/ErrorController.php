<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class ErrorController extends AbstractController
{
    #[Route('/error', name: 'app_error')]
    public function show(Request $request): Response
    {
        return $this->render('Error/No-page.html.twig', [
            'error_message' => $request->get('message', 'Une erreur est survenue.'),
        ]);
    }
}