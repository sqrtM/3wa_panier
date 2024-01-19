<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Cart;
use App\Entity\Product;

class InMemoryStorage implements Storage
{
    private array $carts = [];
    private array $products = [];

    public function setValue(Cart $cart, Product $product, int $quantity): void
    {
    }

    public function restore(): void
    {
    }

    public function reset(): void
    {
    }

    public function total(): int
    {
        return 0;
    }

    public function initCart(): int
    {
        return 0;
    }
}