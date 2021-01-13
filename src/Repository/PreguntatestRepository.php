<?php

namespace App\Repository;

use App\Entity\Preguntatest;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Preguntatest|null find($id, $lockMode = null, $lockVersion = null)
 * @method Preguntatest|null findOneBy(array $criteria, array $orderBy = null)
 * @method Preguntatest[]    findAll()
 * @method Preguntatest[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PreguntatestRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Preguntatest::class);
    }



//    /**
//     * @return Preguntatest[] Returns an array of Preguntatest objects
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
    public function findOneBySomeField($value): ?Preguntatest
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
