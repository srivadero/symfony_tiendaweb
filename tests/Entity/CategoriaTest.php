<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;
use App\Entity\Categoria;
use App\Entity\Producto;

class CategoriaTest extends TestCase
{
    public function testPropertiesDefaultValues()
    {
        $categoria = new Categoria();
        $this->assertSame('', $categoria->__toString());
        $this->assertSame('', $categoria->getNombre());
        $this->assertCount(0, $categoria->getProductos());
    }

    public function testPropertyNombre()
    {
        $categoria = new Categoria();
        $categoria->setNombre('TestCategoria');
        $this->assertSame('TestCategoria', $categoria->getNombre());
    }

    public function testPropertyProductos()
    {
        $categoria = new Categoria();
        $producto = new Producto();

        $categoria->addProducto($producto);
        $this->assertCount(1, $categoria->getProductos());

        $categoria->removeProducto($producto);
        $this->assertCount(0, $categoria->getProductos());
    }
}
