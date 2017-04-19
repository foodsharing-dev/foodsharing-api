<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testGet()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/api/v1/session');

        $this->assertEquals(404, $client->getResponse()->getStatusCode());
    }

    public function testCreate()
    {
        $client = static::createClient();

        $crawler = $client->request(
            'POST',
            '/api/v1/session',
            [
                'email' => 'invalid@account.com',
                'password' => 'somepassword'
            ],
            [],
            [
                'HTTP_ACCEPT' => 'application/json'
            ]
        );

        $response = $client->getResponse();

        $this->assertEquals(200, $response->getStatusCode());

        $this->assertTrue(
            $response->headers->contains('Content-Type', 'application/json'),
            $response->headers
        );

        $this->assertEquals(
            '{"message":"not sure what this should actually be for invalid credentials"}',
            $response->getContent()
        );
    }
}
