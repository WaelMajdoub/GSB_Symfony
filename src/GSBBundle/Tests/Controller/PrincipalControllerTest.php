<?php

namespace GSBBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PrincipalControllerTest extends WebTestCase
{
    public function testConnexion()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/connexion');
    }

    public function testDeconnexion()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/deconnexion');
    }

    public function testAccueil()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/accueil');
    }

    public function testGererfrais()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/gererFrais');
    }

    public function testEtatfrais()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/etatFrais');
    }

}
