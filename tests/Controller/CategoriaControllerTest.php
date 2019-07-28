<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Hautelook\AliceBundle\PhpUnit\RefreshDatabaseTrait;


class CategoriaControllerTest extends WebTestCase
{
    use RefreshDatabaseTrait;

    public function testCanAddCategoria()
    {
        $client = static::createClient([], [
            'PHP_AUTH_USER' => 'admin',
            'PHP_AUTH_PW' => 'admin',
        ]);
        $client->followRedirects();
        
        $client->request('GET', '/admin/categoria');

        $this->assertResponseIsSuccessful();

        
        $client->clickLink('Create new');
        $this->assertSelectorTextContains('h1', 'Create new Categoria');
        $form = $client->submitForm(
            'Save',
            [
                'categoria[nombre]'=>'[phpunit] new categoria',
            ]
        );

        $this->assertSelectorTextContains('h1', 'Categoria index');
    }

    public function testCanEditCategoria()
    {
        $client = static::createClient([], [
            'PHP_AUTH_USER' => 'admin',
            'PHP_AUTH_PW' => 'admin',
        ]);
        $client->followRedirects();
        $client->request('GET', '/admin/categoria');

        $this->assertResponseIsSuccessful();
        $this->assertPageTitleContains('Categorias');

        $client->clickLink('edit');
        $this->assertSelectorTextContains('h1', 'Edit Categoria');
        $form = $client->submitForm(
            'Update',
            [
                'categoria[nombre]'=>'[phpunit] updated categoria',
            ]
        );

        $this->assertSelectorTextContains('h1', 'Categoria index');
    }

}
