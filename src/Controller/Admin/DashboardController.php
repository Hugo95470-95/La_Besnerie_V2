<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Entity\Product;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        // on modifie le chemin de la page d'accueil de l'admin
        return $this->render('admin/dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('La_Besnerie');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Accueil du tableau de bord', 'fa fa-home');
        yield MenuItem::linktoRoute('Retour sur la page d accueil', 'fas fa-home', 'accueil');
        // // Relier les CRUDs
        yield MenuItem::linkToCrud('Produits', 'fas fa-list', Product::class);
        yield MenuItem::linkToCrud('Utilisateurs', 'fas fa-list', User::class);
        yield MenuItem::linkToLogout('Déconnexion', 'fas fa-sign-out-alt', 'logout');
    }
}


// Identifiant Admin
// hcaffin@gmail.com
// azerty

// Identifiant Client
// caffinh.dev.web@gmail.com
// 3333