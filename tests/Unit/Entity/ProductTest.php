<?php

declare(strict_types=1);

namespace App\Tests\Unit\Entity;

use App\Entity\Product;
use App\Repository\InMemoryStorage;
use PHPUnit\Framework\TestCase;

use function PHPUnit\Framework\assertEquals;

class ProductTest extends TestCase
{

    public function testGetName()
    {
        $p =  new Product("hello", 10.0, new InMemoryStorage());
        assertEquals($p->getName(), "hello");
    }

    public function testGetPrice()
    {
        $p =  new Product("hello", 10.0, new InMemoryStorage());
        assertEquals($p->getPrice(), "10.0");
    }

    public function testSetName()
    {
        $p =  new Product("hello", 10.0, new InMemoryStorage());
        $p->setName("world");
        assertEquals($p->getName(), "world");
    }

    public function testSetPrice()
    {
        $p =  new Product("hello", 10.0, new InMemoryStorage());
        $p->setPrice(2.00);
        assertEquals($p->getPrice(), 2.00);
    }
}