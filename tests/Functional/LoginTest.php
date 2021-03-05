<?php

declare(strict_types=1);

namespace App\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\RouterInterface;

class LoginTest extends WebTestCase
{
    public function testIfLoginIsSuccessful(): void
    {
        $client = static::createClient();

        /** @var RouterInterface $router */
        $router = $client->getContainer()->get("router");

        $crawler = $client->request(Request::METHOD_GET, $router->generate("app_login"));

        $form = $crawler->filter("form[name=login]")->form([
            "email" => "admin@email.com",
            "password" => "password"
        ]);

        $client->submit($form);

        $this->assertResponseStatusCodeSame(Response::HTTP_FOUND);

        $client->followRedirect();

        $this->assertRouteSame('home');
    }

    /**
     * @dataProvider provideInvalidCredentials
     * @param string $email
     * @param string $password
     */
    public function testIfCredentialsAreInvalid(string $email, string $password): void
    {
        $client = static::createClient();

        /** @var RouterInterface $router */
        $router = $client->getContainer()->get("router");

        $crawler = $client->request(Request::METHOD_GET, $router->generate("app_login"));

        $form = $crawler->filter("form[name=login]")->form([
            "email" => $email,
            "password" => $password
        ]);

        $client->submit($form);

        $this->assertResponseStatusCodeSame(Response::HTTP_FOUND);

        $client->followRedirect();

        //$this->assertSelectorTextContains("form[name=login] > div.alert", "Data invalid");
    }

    public function provideInvalidCredentials(): iterable
    {
        yield ["fail@email.com", "password"];
        yield ["admin@email.com", "fail"];
    }
}
