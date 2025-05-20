<?php

// namespace App\Controller;

// use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
// use Symfony\Component\HttpFoundation\Response;
// use Symfony\Component\Routing\Attribute\Route;

// final class SummaryController extends AbstractController
// {
//     #[Route('/summary', name: 'app_summary')]
//     public function index(): Response
//     {
//         return $this->render('summary/index.html.twig', [
//             'controller_name' => 'SummaryController',
//         ]);
//     }
// }



namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use App\Service\CartService;

class SummaryController extends AbstractController
{
    #[Route(path: '/summary', name: 'summary')]
    public function index(MailerInterface $mailer, CartService $cartService): Response
    {
        // Récupérer le contenu du panier
        $cartItems = $cartService->getCartItems();
        $cartTotal = $cartService->getTotal();

        // Construire le contenu de l'e-mail
        $emailContent = "<h1>Résumé de votre commande</h1>";
        $emailContent .= "<ul>";
        foreach ($cartItems as $item) {
            $emailContent .= sprintf(
                "<li>%s - %d x %.2f €</li>",
                $item['product']->getName(),
                $item['quantity'],
                $item['product']->getPrice()
            );
        }
        $emailContent .= "</ul>";
        $emailContent .= sprintf("<p>Total : %.2f €</p>", $cartTotal);

        // Envoyer l'e-mail
        $email = (new Email())
            ->from('hcaffin@gmail.com')
            ->to('caffinh.dev.web@gmail.com')
            ->subject('Nouvelle commande')
            ->html($emailContent);

        $mailer->send($email);

        // Afficher la page de confirmation
        return $this->render('summary/index.html.twig');
    }
}
