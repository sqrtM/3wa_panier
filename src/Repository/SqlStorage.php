<?php
declare(strict_types=1);

namespace App\Repository;

use App\Entity\Cart;
use App\Entity\Product;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Exception;

class SqlStorage implements Storage
{
    private $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function setValue(Cart $cart, Product $product, int $quantity): void
    {
    }

    public function restore(): void
    {
    }

    public function reset(): void
    {
    }

    public function total(): int
    {
        return 0;
    }

    /**
     * @throws Exception
     */
    public function initCart(): int
    {
        $sql = 'INSERT INTO carts (id) VALUES (DEFAULT)';
        $this->connection->executeQuery($sql);
        return (int)$this->connection->lastInsertId();
    }
}