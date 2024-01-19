<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Cart;
use App\Entity\Product;

class InMemoryStorage implements Storage
{
    private array $carts = [];
    private array $products = [];

    public function setValue(int $cartId, Product $product, int $quantity): void
    {
    }

    public function restore(int $cartId, Product $product, int $quantity): void
    {
    }

    public function reset(int $cartId): void
    {
    }

    public function total(int $cartId): float
    {
        return 0;
    }

    public function initCart(): int
    {
        return 0;
    }

    public function initProduct(string $name, float $price): int
    {
        return 0;
    }
}