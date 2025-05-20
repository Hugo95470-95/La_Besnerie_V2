<?php
namespace App\Service;

use Symfony\Component\HttpFoundation\Session\SessionInterface;

class CartService
{
    private $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
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
            $total += $item['product']->getPrice() * $item['quantity'];
        }

        return $total;
    }
}
