<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\Storage;

class Cart
{
    private readonly int $id;
    private readonly array $products;

    public function __construct(
        private readonly Storage $storage,
    ) {
        $this->id = $this->storage->initCart();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getSessionProducts(): array
    {
        return $this->products;
    }

    public function setSessionProducts(Product $product, int $amount): void
    {
        $this->products[$product->getId()] = $amount;
    }

    public function resetSession() {
        $this->products = [];
    }

    public function buy(Product $product, int $amount)
    {
        for ($i = 0; $i < $amount; $i++) {
            $this->products[] = $product;
        }
        $this->storage->setValue($this->id, $product, $amount);
    }

    public function reset(): void
    {
        $this->storage->reset($this->id);
        $this->resetSession();
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
        $this->setSessionProducts($product, $amount);
    }

    public function total(): float
    {
        return $this->storage->total($this->id);
    }
}
