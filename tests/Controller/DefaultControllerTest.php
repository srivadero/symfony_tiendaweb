<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response as Response;

/**
 * Functional test that implements a "smoke test" of all the public and secure
 * URLs of the application.
 */
class DefaultControllerTest extends WebTestCase
{
    public function getPublicUrls()
    {
        yield ['/'];
        yield ['/login'];
        yield ['/register'];
        // Add more public ulrs...
    }

    public function getSecureUrls()
    {
        yield ['/admin/producto/'];
        yield ['/admin/producto/new'];
        yield ['/admin/producto/1'];
        yield ['/admin/producto/1/edit'];
        yield ['/admin/categoria'];
        yield ['/admin/categoria/new'];
        yield ['/admin/categoria/1'];
        yield ['/admin/categoria/1/edit'];
        // Add more secure ulrs...
    }

    /**
     * @dataProvider getPublicUrls
     */
    public function testPublicUrls(string $url)
    {
        $client = static::createClient();
        $client->followRedirects();
        $client->request('GET', $url);
        $this->assertResponseIsSuccessful();
    }

    /**
     * The application contains a lot of secure URLs which shouldn't be
     * publicly accessible. This tests ensures that whenever a user tries to
     * access one of those pages, a redirection to the login form is performed.
     *
     * @dataProvider getSecureUrls
     */
    public function testSecureUrls(string $url)
    {
        $client = static::createClient();
        $client->request('GET', $url);
        $response = $client->getResponse();
        $this->assertSame(Response::HTTP_FOUND, $response->getStatusCode());
        $this->assertSame(
            'http://localhost/login',
            $response->getTargetUrl(),
            sprintf('The %s secure URL redirects to the login form.', $url)
        );
    }

}
