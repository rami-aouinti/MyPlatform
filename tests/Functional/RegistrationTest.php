<?php

declare(strict_types=1);

namespace App\Tests\Functional;

use Faker\Factory;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\RouterInterface;

class RegistrationTest extends WebTestCase
{
    public function testIfLoginIsSuccessful(): void
    {
        $faker = Factory::create("de_DE");

        $client = static::createClient();

        /** @var RouterInterface $router */
        $router = $client->getContainer()->get("router");

        $crawler = $client->request(Request::METHOD_GET, $router->generate("app_registration"));

        $form = $crawler->filter("form[name=user]")->form([
            "user[email]" => $faker->email,
            "user[plainPassword]" => $faker->password,
            "user[nickname]" => $faker->userName
        ]);

        $client->submit($form);

        $this->assertResponseStatusCodeSame(Response::HTTP_FOUND);

        $client->followRedirect();

        $this->assertRouteSame('index');
    }

    public function testIfEmailAlreadyExist(): void
    {
        $client = static::createClient();

        /** @var RouterInterface $router */
        $router = $client->getContainer()->get("router");

        $crawler = $client->request(Request::METHOD_GET, $router->generate("app_registration"));

        $form = $crawler->filter("form[name=user]")->form([
            "user[email]" => "rami@email.com",
            "user[plainPassword]" => "password",
            "user[nickname]" => "Rami"
        ]);

        $client->submit($form);

        $this->assertSelectorTextContains("form[name=user] > div", "This value is already used.");
    }
}
