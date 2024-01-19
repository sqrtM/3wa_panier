<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Product;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Exception;

class SqlStorage implements Storage
{
    private Connection $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    /**
     * @throws Exception
     */
    public function setValue(int $cartId, Product $product, int $quantity): void
    {
        $sql = 'INSERT INTO cart_products (cart_id, product_id, quantity) VALUES (:cartId, :productId, :quantity)';
        $params = [
            'cartId' => $cartId,
            'productId' => $product->getId(),
            'quantity' => $quantity,
        ];
        $this->connection->executeQuery($sql, $params);
    }

    /**
     * @throws Exception
     */
    public function restore(int $cartId, Product $product, int $quantity): void
    {
        $updateSql = <<<'SQL'
        UPDATE cart_products
          SET quantity = GREATEST(0, quantity - :quantityToRemove)
          WHERE cart_id = :cartId
            AND product_id = :productId;
        SQL;
        $updateParams = [
            'cartId' => $cartId,
            'productId' => $product->getId(),
            'quantityToRemove' => $quantity,
        ];


        $deleteSql = <<<'SQL'
        DELETE FROM cart_products
          WHERE cart_id = :cartId
            AND product_id = :productId
            AND quantity = 0;
        SQL;
        $deleteParams = [
            'cartId' => $cartId,
            'productId' => $quantity,
        ];

        $this->connection->executeQuery($updateSql, $updateParams);
        $this->connection->executeQuery($deleteSql, $deleteParams);
    }

    /**
     * @throws Exception
     */
    public function reset(int $cartId): void
    {
        $sql = 'DELETE FROM cart_products WHERE cart_id = :cartId';
        $params = ['cartId' => $cartId];
        $this->connection->executeQuery($sql, $params);
    }

    /**
     * @throws Exception
     */
    public function total(int $cartId): float
    {
        $sql = <<<'SQL'
        SELECT
            c.cart_id,
            SUM(p.price * c.quantity) AS total_price
        FROM
            cart_products c
        JOIN
            products p ON c.product_id = p.id
        WHERE
            c.cart_id = :cartId
        GROUP BY
            c.cart_id;
        SQL;
        $params = ['cartId' => $cartId];

        fwrite(STDERR, implode($this->connection->fetchAssociative($sql, $params)));

        return (float)$this->connection->fetchAssociative($sql, $params)["total_price"];
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

    /**
     * @throws Exception
     */
    public function initProduct(string $name, float $price): int
    {
        $sql = 'INSERT INTO products (id, name, price) VALUES (DEFAULT, :name, :price)';
        $params = [
            'name' => $name,
            'price' => $price,
        ];
        $this->connection->executeQuery($sql, $params);
        return (int)$this->connection->lastInsertId();
    }
}