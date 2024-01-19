<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\Storage;

class Cart
{
    private readonly int $id;

    public function __construct(
        private readonly Storage $storage,
    ) {
        $this->id = $this->storage->initCart();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function buy(Product $product, int $amount)
    {
        $this->storage->setValue($this, $product, $amount);
    }

    public function reset(): void
    {
    }

    public function restore()
    {
    }

    public function total()
    {
    }
}