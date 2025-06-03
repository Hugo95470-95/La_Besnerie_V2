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

        // Vérifier si le panier est vide
        if (empty($cartItems)) {
            $this->addFlash('error', "Votre panier est vide.");
            return $this->redirectToRoute('cart'); // Redirige vers la page du panier (à adapter selon votre route)
        }

        // Construire le contenu de l'e-mail
        $emailContent = "<h1>Résumé de votre commande</h1>";
        $emailContent .= "<ul>";
        foreach ($cartItems as $item) {
            // Correction : vérifier que 'product' existe et est un objet valide
            if (!isset($item['product']) || !is_object($item['product'])) {
                continue; // Ignore les éléments invalides
            }
            $emailContent .= sprintf(
                "<li>%s - %d x %.2f €</li>",
                htmlspecialchars($item['product']->getName(), ENT_QUOTES, 'UTF-8'),
                (int)$item['quantity'],
                (float)$item['product']->getPrice()
            );
        }
        $emailContent .= "</ul>";
        $emailContent .= sprintf("<p>Total : %.2f €</p>", (float)$cartTotal);

        // Envoyer l'e-mail avec gestion d'erreur
        try {
            $email = (new Email())
                ->from('hcaffin@gmail.com')
                ->to('caffinh.dev.web@gmail.com')
                ->subject('Nouvelle commande')
                ->html($emailContent);

            $mailer->send($email);
            $mailSent = true;
        } catch (\Exception $e) {
            $mailSent = false;
            $this->addFlash('error', "Erreur lors de l'envoi de l'e-mail : " . $e->getMessage());
        }

        // Afficher la page de confirmation
        return $this->render('summary/index.html.twig', [
            'cartItems' => $cartItems,
            'cartTotal' => $cartTotal,
            'mailSent' => $mailSent,
        ]);
    }
}