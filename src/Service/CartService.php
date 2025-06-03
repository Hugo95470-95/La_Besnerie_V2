<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class CartService
{
    private $session;

    public function __construct(RequestStack $requestStack)
    {
        $this->session = $requestStack->getSession();
    }

    public function getCartItems(): array
    {
        return $this->session->get('cart', []);
    }

    public function getTotal(): float
    {
        $cart = $this->getCartItems();
        $total = 0;

        foreach ($cart as $item) {
            // Correction : vérifier que 'product' existe et est un objet valide
            if (!isset($item['product']) || !is_object($item['product'])) {
                continue; // Ignore les éléments invalides
            }
            $total += $item['product']->getPrice() * $item['quantity'];
        }

        return $total;
    }
}
