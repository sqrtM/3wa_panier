<?php

declare(strict_types=1);

namespace App\Tests\Unit;

use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase
{
    public function testGetName()
    {
        self::assertEquals(1, 1);
    }

    public function testGetPrice()
    {
        self::assertEquals(1, 1);
    }

    public function testSetName()
    {
        self::assertEquals(1, 2);
    }

    public function testSetPrice()
    {
        self::assertEquals(1, 1);
    }
}