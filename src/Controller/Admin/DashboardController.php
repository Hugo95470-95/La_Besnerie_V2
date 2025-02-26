<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Entity\Product;
use App\Entity\Produit;
use App\Entity\Categorie;
use App\Entity\Commentaire;
use App\Entity\Utilisateur;
use App\Entity\Personnalisation;
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
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linktoRoute('Back to the website', 'fas fa-home', 'produit_index');
        // // Relier les CRUDs
        yield MenuItem::linkToCrud('produits', 'fas fa-list', Product::class);
        yield MenuItem::linkToCrud('Utilisateurs', 'fas fa-list', User::class);

    }
}


// identifiant admin
// hcaffin@gmail.com
// azerty