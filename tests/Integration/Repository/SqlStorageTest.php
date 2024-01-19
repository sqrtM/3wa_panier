<?php

declare(strict_types=1);

namespace App\Tests\Integration\Repository;

use App\Entity\Cart;
use App\Entity\Product;
use App\Repository\SqlStorage;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Exception;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class SqlStorageTest extends KernelTestCase
{
    private SqlStorage $storage;
    private EntityManagerInterface $entityManager;

    protected function setUp(): void
    {
        parent::setUp();
        self::bootKernel();

        $container = parent::getContainer();

        $this->entityManager = $container->get('doctrine')->getManager();
        $this->entityManager->beginTransaction();

        $this->storage = $container->get(SqlStorage::class);
    }

    /**
     * @throws Exception
     */
    public function testSetValue()
    {
        $product = new Product("Product", 5.00, $this->storage);
        $this->storage->setValue(1, $product, 2);
        self::assertInstanceOf(Product::class, $product);
    }

    public function testRestore()
    {
        $cart = new Cart($this->storage);
        $product = new Product("Product", 5.00, $this->storage);
        $cart->buy($product, 2);
        $cart->restore($product, 2);
        // todo
    }

    /**
     * @throws Exception
     */
    public function testReset()
    {
        $cart = new Cart($this->storage);
        $product = new Product("Product", 5.00, $this->storage);
        $cart->buy($product, 2);
        $cart->reset();
        // todo
    }

    /**
     * @throws Exception
     */
    public function testTotal()
    {
        self::assertEquals(57.5, $this->storage->total(1));
    }

    public function testInitCart()
    {
        $cartOne = new Cart($this->storage);
        $cartTwo = new Cart($this->storage);

        self::assertInstanceOf(Cart::class, $cartOne);
        self::assertInstanceOf(Cart::class, $cartTwo);
    }

    protected function tearDown(): void
    {
        $this->entityManager->rollback();
        parent::tearDown();
    }
}