<?php

namespace App\Repository;

use App\Entity\Menu;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class MenuRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Menu::class);
    }

    public function findMenus()
    {
        $em = $this->getEntityManager();

           $consulta = $em->createQuery('
            SELECT s.tituloEs AS titulo, s.id AS id, s.enlace AS enlace 
              FROM App:Menu s
          ORDER BY s.id');
        return $consulta->getResult();
    }
    
}
