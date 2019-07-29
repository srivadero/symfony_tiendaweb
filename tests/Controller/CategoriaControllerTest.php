<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Hautelook\AliceBundle\PhpUnit\RefreshDatabaseTrait;


class CategoriaControllerTest extends WebTestCase
{
    use RefreshDatabaseTrait;
    
    public function testPageNavigation()
    {
        // As an admin user access Categoria index
        $client = static::createClient([], [
            'PHP_AUTH_USER' => 'admin',
            'PHP_AUTH_PW' => 'admin',
        ]);
        $client->followRedirects();        
        $client->request('GET', '/admin/categoria');
        $this->assertResponseIsSuccessful();        

        // Then link to 'Create new' and return
        $client->clickLink('Agregar');
        $this->assertSelectorTextContains('h1', 'Nueva Categoria');
        $client->clickLink('Cancelar');
        $this->assertSelectorTextContains('h1', 'Categorias');

        // Then link to 'show'and return
        $client->clickLink('ver');
        $this->assertSelectorTextContains('h1', 'Categoria');
        $client->clickLink('Volver');
        $this->assertSelectorTextContains('h1', 'Categorias');

        // Then link to 'edit' and return
        $client->clickLink('editar');
        $this->assertSelectorTextContains('h1', 'Editar Categoria');
        $client->clickLink('Cancelar');
        $this->assertSelectorTextContains('h1', 'Categorias');

    }

    public function testCanAddCategoria()
    {
        $client = static::createClient([], [
            'PHP_AUTH_USER' => 'admin',
            'PHP_AUTH_PW' => 'admin',
        ]);
        $client->followRedirects();
        $client->request('GET', '/admin/categoria/new');
        $this->assertResponseIsSuccessful();
        $form = $client->submitForm(
            'Guardar',
            [
                'categoria[nombre]'=>'[phpunit] new categoria',
            ]
        );

        $this->assertSelectorTextContains('h1', 'Categorias');
    }

    public function testCanEditCategoria()
    {

        $client = static::createClient([], [
            'PHP_AUTH_USER' => 'admin',
            'PHP_AUTH_PW' => 'admin',
        ]);
        $client->followRedirects();
        $client->request('GET', '/admin/categoria/1/edit');
        $this->assertResponseIsSuccessful();
        $form = $client->submitForm(
            'Actualizar',
            [
                'categoria[nombre]'=>'[phpunit] updated categoria',
            ]
        );

        $this->assertSelectorTextContains('h1', 'Categorias');
    }

}
