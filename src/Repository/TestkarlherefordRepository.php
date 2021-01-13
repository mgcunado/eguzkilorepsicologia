<?php

namespace App\Repository;

use App\Entity\Testkarlhereford;
use App\Entity\Testintocupacionales;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Testkarlhereford|null find($id, $lockMode = null, $lockVersion = null)
 * @method Testkarlhereford|null findOneBy(array $criteria, array $orderBy = null)
 * @method Testkarlhereford[]    findAll()
 * @method Testkarlhereford[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TestkarlherefordRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Testkarlhereford::class);
    }



    /**
     * @return Testkarlhereford[] Returns an array of Testkarlhereford objects
     */
    public function findPreguntas()
    {
        $em = $this->getEntityManager();

           $consulta = $em->createQuery('
            SELECT s
             FROM App:Testkarlhereford s
             JOIN s.intereseskarlhereford c 
          ORDER BY s.id');
        return $consulta->getResult();
    }
    
    public function findPreguntasocup()
    {
        $em = $this->getEntityManager();

           $consulta = $em->createQuery('
            SELECT s
             FROM App:Testintocupacionales s
          ORDER BY s.id');
        return $consulta->getResult();
    }
    
    public function findPreguntasaptitudes()
    {
        $em = $this->getEntityManager();

           $consulta = $em->createQuery('
            SELECT s
             FROM App:Testintaptitudes s
          ORDER BY s.id');
        return $consulta->getResult();
    }
    



    /*
    public function findOneBySomeField($value): ?Testkarlhereford
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
