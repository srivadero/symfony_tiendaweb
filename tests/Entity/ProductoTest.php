<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;
use App\Entity\Producto;

class ProductoTest extends TestCase
{

    // private $producto = null;

    // public function setUp()
    // {
    //     $this->producto = new Producto();
    // }

    public function testDefaultValues()
    {
        $producto = new Producto();

        $this->assertSame("", $producto->__toString());
        $this->assertSame("", $producto->getNombre());
        $this->assertSame(0, $producto->getPrecio());
        $this->assertSame(0, $producto->getStock());
        $this->assertSame(null, $producto->getCategoria());
    }
}
