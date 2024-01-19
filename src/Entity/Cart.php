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
        $this->storage->setValue($this->id, $product, $amount);
    }

    public function reset(): void
    {
        $this->storage->reset($this->id);
    }

    /**
     * Removes a product from the cart
     * @param Product $product
     * @param int $amount
     * @return void
     */
    public function restore(Product $product, int $amount): void
    {
        $this->storage->restore($this->id, $product, $amount);
    }

    public function total(): void
    {
        $this->storage->total($this->id);
    }
}
