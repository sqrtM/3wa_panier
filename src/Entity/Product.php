<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\Storage;

class Product
{
    private readonly int $id;

    public function __construct(
        private readonly string $name,
        private readonly float $price,
        private readonly Storage $storage,
    )
    {
        $this->id = $this->storage->initProduct($this->name, $this->price);
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPrice(): float
    {
        return $this->price;
    }
}