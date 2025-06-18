<?php

namespace App\Controller;

use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

final class OrderController extends AbstractController
{
    #[Route('/cart', name: 'cart_index')]
    public function index(SessionInterface $session): Response
    {
        $cart = $session->get('cart', []);

       $totalProduits = 0;
        $totalPrix = 0;
        foreach ($cart as $item) {
            $totalProduits += $item['quantity'];
            $totalPrix += $item['product']->getPrice() * $item['quantity'];
        }

        return $this->render('order/index.html.twig', [
            'cart' => $cart,
            'totalProduits' => $totalProduits,
            'totalPrix' => $totalPrix,
        ]);
    
    }

    #[Route('/cart/add/{id}', name: 'cart_add', methods: ['POST'])]
    public function add(Product $product, Request $request, SessionInterface $session): Response
    {
        $quantite = (int) $request->request->get('quantite', 1);

        $this->ajouterAuPanier($product, $quantite, $session);

        return $this->redirectToRoute('cart_index');
    }

    // Ajoute cette méthode privée dans le contrôleur
    private function ajouterAuPanier(Product $product, int $quantite, SessionInterface $session): void
    {
        $cart = $session->get('cart', []);
        $id = $product->getId();

        if (!isset($cart[$id])) {
            $cart[$id] = [
                'product' => $product,
                'quantity' => $quantite
            ];
        } else {
            $cart[$id]['quantity'] += $quantite;
        }

        $session->set('cart', $cart);
    }

    #[Route('/cart/remove-quantity/{id}', name: 'cart_remove_quantity', methods: ['POST'])]
    public function removeQuantity(Product $product, Request $request, SessionInterface $session): Response
    {
        $quantite = (int) $request->request->get('quantite', 1);
        $cart = $session->get('cart', []);
        $id = $product->getId();

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] -= $quantite;
            if ($cart[$id]['quantity'] <= 0) {
                unset($cart[$id]);
            }
            $session->set('cart', $cart);
        }

        return $this->redirectToRoute('cart_index');
    }

    #[Route('/cart/remove/{id}', name: 'cart_remove', methods: ['POST'])]
    public function remove(Product $product, SessionInterface $session): Response
    {
        $cart = $session->get('cart', []);
        $id = $product->getId();

        if (isset($cart[$id])) {
            unset($cart[$id]);
        }

        $session->set('cart', $cart);

        return $this->redirectToRoute('cart_index');
    }

    #[Route('/cart/validate', name: 'cart_validate', methods: ['POST'])]
    public function validate(SessionInterface $session): Response
    {
        // Logique de validation du panier (par exemple, créer une commande, envoyer un email, etc.)
        // Pour cet exemple, nous allons simplement vider le panier et rediriger vers une page de confirmation.

        $session->remove('cart');

        return $this->redirectToRoute('cart_confirmation');
    }

    #[Route('/cart/confirmation', name: 'cart_confirmation')]
    public function confirmation(): Response
    {
        return $this->render('order/confirmation.html.twig');
    }

    #[Route('/cart/summary', name: 'summary')]
    public function summary(Request $request, SessionInterface $session): Response
    {
        $cart = $session->get('cart', []);

        return $this->render('order/summary.html.twig', [
            'cart' => $cart,
        ]);

    }
}