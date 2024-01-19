<?php

namespace App\Repository;

use App\Entity\Cart;
use App\Entity\Product;

interface Storage
{
    public function setValue(int $cartId, Product $product, int $quantity): void;

    public function restore(int $cartId, Product $product, int $quantity): void;
    public function reset(int $cartId): void;
    public function total(int $cartId): float;
    public function initCart(): int;
    public function initProduct(string $name, float $price): int;

}