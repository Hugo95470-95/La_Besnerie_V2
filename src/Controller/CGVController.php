<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CGVController extends AbstractController
{
    #[Route('/cgv', name: 'cgv')]
    public function cgv(): Response
    {
        return $this->render('CGV/cgv.html.twig');
    }

    #[Route('/confidentialite', name: 'confidentialite')]
    public function confidentialite(): Response
    {
        return $this->render('CGV/confidentialite.html.twig');
    }

    #[Route('/mention', name: 'mention')]
    public function mention(): Response
    {
        return $this->render('CGV/mention.html.twig');
    }
}