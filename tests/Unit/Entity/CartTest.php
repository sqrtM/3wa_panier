<?php

declare(strict_types=1);

namespace App\Tests\Unit\Entity;

use App\Repository\InMemoryStorage;
use App\Repository\Storage;
use PHPUnit\Framework\TestCase;

class CartTest extends TestCase
{
    private Storage $storage;

    protected function setUp(): void
    {
        parent::setUp();
        $this->storage = new InMemoryStorage();
    }

    public function testBuy()
    {
        self::assertEquals(1, 1);
    }

    public function testReset()
    {
        self::assertEquals(1, 1);
    }

    public function testRestore()
    {
        self::assertEquals(1, 1);
    }

    public function testTotal()
    {
        self::assertEquals(1, 1);
    }
}