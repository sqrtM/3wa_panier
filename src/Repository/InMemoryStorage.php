<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Cart;
use App\Entity\Product;

class InMemoryStorage implements Storage
{
    public array $carts;
    public array $products = [];

    public function __construct()
    {
        $this->carts = [new Cart($this)];
    }

    public function setValue(int $cartId, Product $product, int $quantity): void
    {
        $cart = new Cart($this);
        $cart->setSessionProducts($product, $quantity);
        $this->carts[$cartId - 1] = $cart;
    }

    public function restore(int $cartId, Product $product, int $quantity): void
    {
        $this->carts[$cartId - 1]->setSessionProducts($product, $quantity);
    }

    public function reset(int $cartId): void
    {
        $this->carts[$cartId - 1]->resetSession();
    }

    public function total(int $cartId): float
    {
        return array_sum(array_map(function ($p) {
            $p->getPrice();
        }, $this->carts[$cartId - 1]->getSessionProducts()));
    }

    public function initCart(): int
    {
        $this->carts[] = new Cart($this);
        return count($this->carts);
    }

    public function initProduct(string $name, float $price): int
    {
        $this->products[] = new Product('New Product', 10.00, $this);
        return count($this->products);
    }
}