<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\HttpKernel\Event\RequestEvent;


final class AdminCrudController extends AbstractController
{
    #[Route('/admin/crud', name: 'app_admin_crud')]
    public function index(): Response
    {
        return $this->render('admin_crud/index.html.twig', [
            'controller_name' => 'AdminCrudController',
        ]);
    }

    
    #[Route('/logout', name: 'app_logout')]
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}

// class LogoutListener
// {
//     private $flashBag;

//     public function __construct(FlashBagInterface $flashBag)
//     {
//         $this->flashBag = $flashBag;
//     }

//     public function onKernelRequest(RequestEvent $event)
//     {
//         if ($event->getRequest()->attributes->get('_route') === 'accueil') {
//             $this->flashBag->add('success', 'Vous avez été déconnecté avec succès.');
//         }
//     }
// }
