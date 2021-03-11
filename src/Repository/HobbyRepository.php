<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Hobby;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * Class HobbyRepository
 * @package App\Repository
 */
class HobbyRepository extends ServiceEntityRepository
{
    /**
     * LanguageRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Hobby::class);
    }
}
