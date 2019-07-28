<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Hautelook\AliceBundle\PhpUnit\RefreshDatabaseTrait;

class ProductoControllerTest extends WebTestCase
{
    use RefreshDatabaseTrait;

    public function testCanAddProducto()
    {
        $client = static::createClient([], [
            'PHP_AUTH_USER' => 'admin',
            'PHP_AUTH_PW' => 'admin',
        ]);
        $client->followRedirects();
        
        $client->request('GET', '/admin/producto');

        $this->assertResponseIsSuccessful();

        
        $client->clickLink('Agregar');
        $this->assertSelectorTextContains('h1', 'Create new Producto');
        $form = $client->submitForm(
            'Save',
            [
                'producto[nombre]'=>'[phpunit] new product',
                'producto[precio]'=>'99',
                'producto[stock]'=>'6',
            ]
        );

        $this->assertSelectorTextContains('h1', 'Productos');
    }

    public function testCanEditProducto()
    {
        $client = static::createClient([], [
            'PHP_AUTH_USER' => 'admin',
            'PHP_AUTH_PW' => 'admin',
        ]);
        $client->followRedirects();
        $client->request('GET', '/admin/producto');

        $this->assertResponseIsSuccessful();
        
        $client->clickLink('editar');
        $this->assertSelectorTextContains('h1', 'Edit Producto');
        $form = $client->submitForm(
            'Update',
            [
                'producto[nombre]'=>'[phpunit] updated product',
                'producto[precio]'=>'99',
                'producto[stock]'=>'6',
            ]
        );

        $this->assertSelectorTextContains('h1', 'Productos');
    }
}
