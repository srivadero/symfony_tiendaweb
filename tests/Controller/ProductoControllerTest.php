<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Hautelook\AliceBundle\PhpUnit\RefreshDatabaseTrait;

class ProductoControllerTest extends WebTestCase
{
    use RefreshDatabaseTrait;

    public function testPageNavigation()
    {
        // As an admin user access Producto index
        $client = static::createClient([], [
            'PHP_AUTH_USER' => 'admin',
            'PHP_AUTH_PW' => 'admin',
        ]);
        $client->followRedirects();        
        $client->request('GET', '/admin/producto');
        $this->assertResponseIsSuccessful();        

        // Then link to 'Create new' and return
        $client->clickLink('Agregar');
        $this->assertSelectorTextContains('h1', 'Nuevo Producto');
        $client->clickLink('Cancelar');
        $this->assertSelectorTextContains('h1', 'Productos');

        // Then link to 'show'and return
        $client->clickLink('ver');
        $this->assertSelectorTextContains('h1', 'Producto');
        $client->clickLink('Volver');
        $this->assertSelectorTextContains('h1', 'Productos');

        // Then link to 'edit' and return
        $client->clickLink('editar');
        $this->assertSelectorTextContains('h1', 'Editar Producto');
        $client->clickLink('Cancelar');
        $this->assertSelectorTextContains('h1', 'Productos');

    }

    public function testCanAddProducto()
    {
        $client = static::createClient([], [
            'PHP_AUTH_USER' => 'admin',
            'PHP_AUTH_PW' => 'admin',
        ]);
        $client->followRedirects();        
        $client->request('GET', '/admin/producto/new');
        $this->assertResponseIsSuccessful();
        $form = $client->submitForm(
            'Guardar',
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
        $client->request('GET', '/admin/producto/1/edit');

        $this->assertResponseIsSuccessful();
        
        $form = $client->submitForm(
            'Actualizar',
            [
                'producto[nombre]'=>'[phpunit] updated product',
                'producto[precio]'=>'99',
                'producto[stock]'=>'6',
            ]
        );

        $this->assertSelectorTextContains('h1', 'Productos');
    }
}
