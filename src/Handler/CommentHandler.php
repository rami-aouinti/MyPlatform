<?php

namespace App\Handler;

/*
 *
 * Date : 04/03/2021, 00:48
 * Author : rami
 * Class CommentHandler.php
 */

use App\Form\CommentType;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class CommentHandler
 * @package App\Handler
 */
class CommentHandler extends AbstractHandler
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
        return CommentType::class;
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
