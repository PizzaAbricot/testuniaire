<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UrlTest extends WebTestCase
{
    /**
     * @dataProvider urlProvider
     */
    public function testUrl($url)
    {
        $client = static::createClient();
        $crawler = $client->request('GET', $url);
        // var_dump($crawler);
        $this->assertResponseIsSuccessful();
      //  $this->assertSelectorTextContains('h1', 'Hello World');
    }

    public function urlProvider()
    {
        yield ['/'];
        yield ['/boutique/'];
        yield ['/fr/contact_page/'];
        yield ['/boutique/1'];
        yield ['/boutique/2'];
        yield ['/boutique/3'];
        yield ['/panier'];
        
    }
}
