<?php

namespace App\Repository;

use App\Entity\Cart;
use App\Entity\Product;

interface Storage
{
    public function setValue(Cart $cart, Product $product, int $quantity): void;
    public function restore(): void;
    public function reset(): void;
    public function total(): int;
    public function initCart(): int;
}