<?php

declare(strict_types=1);

namespace App\Entity;

class Product
{

    public function __construct(
        private readonly string $name,
        private readonly float $price,
    )
    {
    }
    public function getName()
    {
    }

    public function getPrice()
    {
    }
}