<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Post;
use App\Entity\User;
use DateTimeImmutable;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;

class UserFixtures extends Fixture
{
    private Generator $faker;

    public function __construct()
    {
        $this->faker = Factory::create("en_EN");
    }

    public function load(ObjectManager $manager)
    {
        $manager->persist((new User())
            ->setEmail("user+suspended@email.com")
            ->setPlainPassword("password")
            ->setNickname("user+suspended")
            ->setSuspendedAt(new DateTimeImmutable()));
        $manager->persist((new User())
            ->setEmail("user+1@email.com")
            ->setPlainPassword("password")
            ->setNickname("user+1"));
        $manager->persist((new User())
            ->setEmail("admin@email.com")
            ->setPlainPassword("password")
            ->setNickname("admin")
            ->setRoles(["ROLE_ADMIN"]));

        for ($i = 0; $i < 30; $i++) {
            $user = new User();
            $user->setEmail('email@email.com' . $i);
            $user->setNickname('username' . $i);
            $user->setPlainPassword('password');
            $user->setRoles(["ROLE_USER"]);
            $manager->persist($user);

            for ($j = 0; $j < 10; $j++) {
                $post = new Post();
                $post->setTitle('title post' .  $i . $j);
                $post->setDescription('this is description of post ' . $i . $j);
                $post->setAuthor($user);
                $post->setUrl('url' . $i . $j);
                $manager->persist($post);
            }
        }



        $manager->flush();
    }
}
