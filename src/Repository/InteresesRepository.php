<?php

namespace App\Repository;

use App\Entity\Intereses;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Intereses|null find($id, $lockMode = null, $lockVersion = null)
 * @method Intereses|null findOneBy(array $criteria, array $orderBy = null)
 * @method Intereses[]    findAll()
 * @method Intereses[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InteresesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Intereses::class);
    }

//    /**
//     * @return Intereses[] Returns an array of Intereses objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Intereses
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
