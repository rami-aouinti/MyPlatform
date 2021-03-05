<?php

namespace App\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class HomeTest
 * @package App\Tests\Functional
 */
class HomeTest extends WebTestCase
{
    /**
     * @dataProvider provideUri
     * @param string $uri
     */
    public function testHome(string $uri)
    {
        $client = static::createClient();
        $client->request(Request::METHOD_GET, $uri);
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
    }

    /**
     * @return \Generator
     */
    public function provideUri(): \Generator
    {
        yield ['/'];
    }
}
