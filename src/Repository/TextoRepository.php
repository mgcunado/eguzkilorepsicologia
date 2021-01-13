<?php

namespace App\Repository;

use App\Entity\Texto;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class TextoRepository extends ServiceEntityRepository
{
   public function __construct(ManagerRegistry $registry)
   {
      parent::__construct($registry, Texto::class);
   }


   public function findTextos($ide)
   {
      $em = $this->getEntityManager();

      $consulta = $em->createQuery('
            SELECT s.textoEs AS texto, s.id AS id 
              FROM App:Texto s
              WHERE s.id = :id
          ORDER BY s.id');
$consulta->setParameter('id', $ide);
        return $consulta->getResult();
    }

}
