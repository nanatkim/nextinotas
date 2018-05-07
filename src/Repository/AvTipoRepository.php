<?php

namespace App\Repository;

use App\Entity\AvTipo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method AvTipo|null find($id, $lockMode = null, $lockVersion = null)
 * @method AvTipo|null findOneBy(array $criteria, array $orderBy = null)
 * @method AvTipo[]    findAll()
 * @method AvTipo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AvTipoRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, AvTipo::class);
    }

//    /**
//     * @return AvTipo[] Returns an array of AvTipo objects
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
    public function findOneBySomeField($value): ?AvTipo
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
