<?php

declare(strict_types=1);

namespace App\Tests\Integration\Repository;

use App\Entity\Cart;
use App\Repository\SqlStorage;
use Doctrine\DBAL\Connection;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class SqlStorageTest extends KernelTestCase
{
    private SqlStorage $storage;
    private Connection $connection;

    protected function setUp(): void
    {
        parent::setUp();
        self::bootKernel();

        $container = parent::getContainer();
        $this->storage = $container->get(SqlStorage::class);
        $this->connection = $container->get(Connection::class);
    }

    public function testSetValue()
    {
        self::assertEquals(1, 1);
    }

    public function testRestore()
    {
        self::assertEquals(1, 1);
    }

    public function testReset()
    {
        self::assertEquals(1, 1);
    }

    public function testTotal()
    {
        self::assertEquals(1, 1);
    }

    public function testInitCart()
    {
        $cartOne = new Cart($this->storage);
        $cartTwo = new Cart($this->storage);

        self::assertInstanceOf(Cart::class, $cartOne);
        self::assertInstanceOf(Cart::class, $cartTwo);
    }
}