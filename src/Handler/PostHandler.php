<?php

namespace App\Handler;

/*
 *
 * Date : 04/03/2021, 00:48
 * Author : rami
 * Class PostHandler.php
 */

use App\Form\PostType;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class PostHandler
 * @package App\Handler
 */
class PostHandler extends AbstractHandler
{

    /**
     * @var EntityManagerInterface
     */
    private EntityManagerInterface $manager;

    /**
     * CommentHandler constructor.
     * @param EntityManagerInterface $manager
     */
    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    /**
     * @return string
     */
    protected function getFormType(): string
    {
        return PostType::class;
    }

    /**
     * @param $data
     * @return void
     */
    protected function process($data): void
    {
        $this->manager->persist($data);
        $this->manager->flush();
    }
}
