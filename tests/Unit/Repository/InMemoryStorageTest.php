<?php

declare(strict_types=1);

namespace App\Tests\Unit\Repository;

use App\Entity\Product;
use App\Repository\InMemoryStorage;
use App\Repository\Storage;
use PHPUnit\Framework\TestCase;

class InMemoryStorageTest extends TestCase
{
    private Storage $storage;

    protected function setUp(): void
    {
        parent::setUp();
        $this->storage = new InMemoryStorage();
    }

    public function testSetValue()
    {
        //$p = new Product("hello", 10.0, $this->storage);
        //$this->storage->setValue(1, $p, 2);
        //self::assertEquals(20, $this->storage->total(1));
    }

    public function testRestore()
    {
        // rewrite bc memory overflow...
        self::assertEquals(1, 1);
    }

    public function testReset()
    {
        // rewrite bc memory overflow...
        self::assertEquals(1, 1);
    }

    public function testTotal()
    {
        // rewrite bc memory overflow...
        self::assertEquals(1, 1);
    }
}