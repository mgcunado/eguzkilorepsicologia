<?php

namespace App\Repository;

use App\Entity\Facturas;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Facturas|null find($id, $lockMode = null, $lockVersion = null)
 * @method Facturas|null findOneBy(array $criteria, array $orderBy = null)
 * @method Facturas[]    findAll()
 * @method Facturas[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FacturasRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Facturas::class);
    }

    // /**
    //  * @return Facturas[] Returns an array of Facturas objects
    //  */
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
    public function findOneBySomeField($value): ?Facturas
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function findFactura($ide)
    {
        $em = $this->getEntityManager();

           $consulta = $em->createQuery('
            SELECT s.numerofactura AS numerofactura, s.referencia AS referencia, s.producto AS producto, s.fechafactura AS fechafactura, s.duracion AS duracion, s.importe AS importe, s.modopago AS modopago, c.nombre AS nombre, c.direccion AS direccion 
              FROM App:Facturas s
              JOIN s.nombre c
             WHERE s.numerofactura = :numerofactura
          ORDER BY s.numerofactura');
        $consulta->setParameter('numerofactura', $ide);
        //$consulta->setParameter('numerofactura', '0048');
        return $consulta->getResult();
    }

     public function findUltimasfacturas()
    {
        $em = $this->getEntityManager();

           $consulta = $em->createQuery('
            SELECT s.numerofactura AS numerofactura 
              FROM App:Facturas s
          ORDER BY s.numerofactura DESC');
           $consulta->setMaxResults(10);

        return $consulta->getResult();
    }

   
}
