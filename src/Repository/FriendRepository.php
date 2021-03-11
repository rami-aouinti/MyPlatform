<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Friend;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Friend|null find($id, $lockMode = null, $lockVersion = null)
 * @method Friend|null findOneBy(array $criteria, array $orderBy = null)
 * @method Friend[]    findAll()
 * @method Friend[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FriendRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Friend::class);
    }

    /**
     * @param $value
     * @return int|mixed|string
     */
    public function findByUser($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.sender = :val')
            ->orWhere('f.receiver = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->getQuery()
            ->getResult();
    }
}
