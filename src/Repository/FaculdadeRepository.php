<?php

namespace App\Repository;

use App\Entity\Faculdade;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Faculdade|null find($id, $lockMode = null, $lockVersion = null)
 * @method Faculdade|null findOneBy(array $criteria, array $orderBy = null)
 * @method Faculdade[]    findAll()
 * @method Faculdade[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FaculdadeRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Faculdade::class);
    }

//    /**
//     * @return Faculdade[] Returns an array of Faculdade objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Faculdade
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
