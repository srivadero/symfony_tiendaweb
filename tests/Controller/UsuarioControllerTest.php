<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UsuarioControllerTest extends WebTestCase
{
    public function testNavigation()
    {
        $this->markTestIncomplete();
    }

    public function testSomething()
    {
        // As an admin user access Usuario index
        $client = static::createClient([], [
            'PHP_AUTH_USER' => 'admin',
            'PHP_AUTH_PW' => 'admin',
        ]);
        $client->followRedirects();        
        $client->request('GET', '/admin/usuario');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Usuarios');
    }
}
