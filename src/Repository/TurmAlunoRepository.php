<?php

namespace App\Repository;

use App\Entity\TurmAluno;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method TurmAluno|null find($id, $lockMode = null, $lockVersion = null)
 * @method TurmAluno|null findOneBy(array $criteria, array $orderBy = null)
 * @method TurmAluno[]    findAll()
 * @method TurmAluno[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TurmAlunoRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, TurmAluno::class);
    }

//    /**
//     * @return TurmAluno[] Returns an array of TurmAluno objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TurmAluno
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
