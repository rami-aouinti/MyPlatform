<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Attribute;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * Class SkillRepository
 * @package App\Repository
 */
class AttributeRepository extends ServiceEntityRepository
{
    /**
     * SkillRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Attribute::class);
    }
}
