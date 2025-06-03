<?php

namespace App\Controller;

use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccueilController extends AbstractController
{
    #[Route('/', name: 'accueil')]
    // public function index(): Response
    public function index(EntityManagerInterface $entityManager): Response

    {
        return $this->render('accueil/index.html.twig', [
            'controller_name' => 'AccueilController',
        ]);
    }
}


// Code de David
// {% extends 'base.html.twig' %}

// {% block title %}Accueil{% endblock %}

// {% block body %}
//     <h1>Accueil</h1>

//     <a href="{{ path('app_boutique') }}">
//         <button>Boutique</button>
//     </a>
// {% endblock %}

// 