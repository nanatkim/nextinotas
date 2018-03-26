<?php

namespace App\Repository;

use App\Entity\AvBase;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method AvBase|null find($id, $lockMode = null, $lockVersion = null)
 * @method AvBase|null findOneBy(array $criteria, array $orderBy = null)
 * @method AvBase[]    findAll()
 * @method AvBase[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AvBaseRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, AvBase::class);
    }

//    /**
//     * @return AvBase[] Returns an array of AvBase objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?AvBase
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
