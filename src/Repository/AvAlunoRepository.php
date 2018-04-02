<?php

namespace App\Repository;

use App\Entity\AvAluno;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method AvAluno|null find($id, $lockMode = null, $lockVersion = null)
 * @method AvAluno|null findOneBy(array $criteria, array $orderBy = null)
 * @method AvAluno[]    findAll()
 * @method AvAluno[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AvAlunoRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, AvAluno::class);
    }

//    /**
//     * @return AvAluno[] Returns an array of AvAluno objects
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
    public function findOneBySomeField($value): ?AvAluno
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
