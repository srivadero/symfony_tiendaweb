<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;
use App\Entity\Producto;
use App\Entity\Categoria;

class ProductoTest extends TestCase
{

    public function testPropertiesDefaultValues()
    {
        $producto = new Producto();

        $this->assertSame('', $producto->__toString());
        $this->assertSame('', $producto->getNombre());
        $this->assertSame(0, $producto->getPrecio());
        $this->assertSame(0, $producto->getStock());
        $this->assertSame(null, $producto->getCategoria());
    }

    public function testPropertyNombre()
    {
        $producto = new Producto();
        $producto->setNombre('TestProducto');
        $this->assertSame('TestProducto', $producto->getNombre());
    }

    public function testPropertyPrecio()
    {
        $producto = new Producto();
        $producto->setPrecio(99);
        $this->assertSame(99, $producto->getPrecio());
    }

    public function testPropertyStock()
    {
        $producto = new Producto();
        $producto->setStock(6);
        $this->assertSame(6, $producto->getStock());
    }

    public function testPropertyCategoria()
    {
        $producto = new Producto();
        $categoria = new Categoria();
        $producto->setCategoria($categoria);
        $this->assertSame($categoria, $producto->getCategoria());
    }

}
