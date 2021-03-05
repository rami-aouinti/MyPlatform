<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Comment;
use App\Entity\Formation;
use App\Entity\Media;
use App\Entity\Post;
use App\Entity\Reference;
use App\Entity\Skill;
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
        $posts = [];
        $users = [];
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
            $users[] = $user;

            for ($j = 0; $j < 10; $j++) {
                $post = new Post();
                $post->setTitle('title post' .  $i . $j);
                $post->setDescription('this is description of post ' . $i . $j);
                $post->setAuthor($user);
                $post->setUrl('url' . $i . $j);
                $manager->persist($post);
                $posts[] = $post;
            }
        }

        foreach ($posts as $post) {
            foreach ($users as $user) {
                $comment = new Comment();
                $comment->setComment('this is an example of comment');
                $comment->setAuthor($user);
                $comment->setPost($post);
                $manager->persist($comment);
            }
        }

        for ($i = 1; $i <= 5; $i++) {
            $reference = new Reference();
            $reference->setTitle("Reference " . $i);
            $reference->setCompany("Company " . $i);
            $reference->setDescription("Description " . $i);
            $reference->setStartedAt(new \DateTimeImmutable("10 years ago"));
            $reference->setEndedAt(new \DateTimeImmutable("8 years ago"));
            $media = new Media();
            $media->setPath("uploads/image.png");
            $reference->addMedia($media);
            $manager->persist($reference);

            $skill = new Skill();
            $skill->setLevel(rand(1, 10));
            $skill->setName("Skill " . $i);
            $manager->persist($skill);

            $formation = new Formation();
            $formation->setGradeLevel(rand(0, 5));
            $formation->setDescription("Description " . $i);
            $formation->setSchool("School " . $i);
            $formation->setName("Formation " . $i);
            $formation->setStartedAt(new \DateTimeImmutable("10 years ago"));
            $formation->setEndedAt(new \DateTimeImmutable("8 years ago"));
            $manager->persist($formation);
        }

        $manager->flush();
    }
}
