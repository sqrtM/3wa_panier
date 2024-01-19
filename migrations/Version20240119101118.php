<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240119101118 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Initial migration';
    }

    public function up(Schema $schema): void
    {
        // Création de la table des produits
        $this->addSql('CREATE TABLE products (
            id SERIAL NOT NULL,
            name VARCHAR(255) NOT NULL,
            price DECIMAL(10, 2) NOT NULL,
            PRIMARY KEY(id)
        )');

        // Ajout de quelques produits de test
        $this->addSql("INSERT INTO products (name, price) VALUES
            ('apple', 10.5),
            ('raspberry', 13.0),
            ('orange', 7.5)");

        // Création de la table de stockage en mémoire
        $this->addSql('CREATE TABLE in_memory_storage (
            product_id INT NOT NULL,
            quantity INT NOT NULL,
            PRIMARY KEY(product_id),
            CONSTRAINT FK_in_memory_storage_product_id FOREIGN KEY (product_id) REFERENCES products (id) ON DELETE CASCADE
        )');

        // Création de la table des paniers
        $this->addSql('CREATE TABLE carts (
            id SERIAL NOT NULL,
            PRIMARY KEY(id)
        )');

        // Création de la table des produits dans le panier
        $this->addSql('CREATE TABLE cart_products (
            cart_id INT NOT NULL,
            product_id INT NOT NULL,
            quantity INT NOT NULL,
            PRIMARY KEY(cart_id, product_id),
            CONSTRAINT FK_cart_products_cart_id FOREIGN KEY (cart_id) REFERENCES carts (id) ON DELETE CASCADE,
            CONSTRAINT FK_cart_products_product_id FOREIGN KEY (product_id) REFERENCES products (id) ON DELETE CASCADE
        )');

        // Ajout de quelques paniers et produits dans les paniers
        $this->addSql('INSERT INTO carts DEFAULT VALUES');
        $this->addSql('INSERT INTO cart_products (cart_id, product_id, quantity) VALUES
            (1, 1, 3),
            (1, 2, 2)');
    }

    public function down(Schema $schema): void
    {
        // Drop tables in reverse order
        $this->addSql('DROP TABLE IF EXISTS cart_products');
        $this->addSql('DROP TABLE IF EXISTS carts');
        $this->addSql('DROP TABLE IF EXISTS in_memory_storage');
        $this->addSql('DROP TABLE IF EXISTS products');
    }
}
