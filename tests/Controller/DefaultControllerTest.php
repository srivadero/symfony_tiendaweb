<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testHomePageLoadsSuccessfully()
    {
        $client = static::createClient();
        $client->followRedirects();
        $crawler = $client->request('GET', '/');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Inicio');
    }

    public function testTestLinkLoadsSuccessfully()
    {
        $client = static::createClient();
        $client->followRedirects();
        $client->request('GET', '/test');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Test Page');

        $crawler = $client->clickLink('Link');
        $this->assertSelectorTextContains('h1', 'Test Form');

        $form = $client->submitForm(
            'Login',
            [
                'form[name]'=>'testName',
                'form[password]'=>'testPass'
            ]
        );
        $this->assertSelectorTextContains('h1', 'Test Page');

    }
}
