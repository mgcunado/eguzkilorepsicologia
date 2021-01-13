<?php

namespace App\Repository;

use App\Entity\Images;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Images|null find($id, $lockMode = null, $lockVersion = null)
 * @method Images|null findOneBy(array $criteria, array $orderBy = null)
 * @method Images[]    findAll()
 * @method Images[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ImagesRepository extends ServiceEntityRepository
{
	public function __construct(ManagerRegistry $registry)
	{
		parent::__construct($registry, Images::class);
	}

	public function findRows($tipo)
	{
		$em = $this->getEntityManager();

		$consulta = $em->createQuery('
				SELECT s 
				FROM App:Images s
				WHERE s.tipo = :tipo AND s.incluido = :incluido
			   ORDER BY s.imgorder');
				$consulta->setParameter('tipo', $tipo);
				$consulta->setParameter('incluido', 'si');

		  		return $consulta->getResult();
	 }

   public function findRowsoriginal($tipo)
	{
		$em = $this->getEntityManager();

		$consulta = $em->createQuery('
				SELECT s 
				FROM App:Images s
				WHERE s.tipo = :tipo AND s.incluido = :incluido
			   ORDER BY s.imgorderrand');
				$consulta->setParameter('tipo', $tipo);
				$consulta->setParameter('incluido', 'si');

		  		return $consulta->getResult();
	 }

	public function findRowsfixrand($cantidadimages, $tipo)
	{
		$em = $this->getEntityManager();

		$consulta = $em->createQuery('
				SELECT s 
				FROM App:Images s
				WHERE s.tipo = :tipo
            ORDER BY rand()
            ');
				$consulta->setParameter('tipo', $tipo);
            $query = $consulta->getResult();

       $update = $em->createQuery('
            UPDATE App:Images s
            SET s.incluido = :incluido
            ');
            $update->setParameter('incluido', 'no');
            $update->getResult();
            
          $contador = 1;

          for($i=0; $i < $cantidadimages; $i++){
          $contadormenosuno = $contador - 1;
           $id = $query[$contadormenosuno]->getId();
           $update2 = $em->createQuery('
            UPDATE App:Images s
            SET s.imgorderrand = :imgorderrand, s.incluido = :incluido
            WHERE s.id = :id
            ');
           $update2->setParameter('imgorderrand', $contador);
           $update2->setParameter('incluido', 'si');
           $update2->setParameter('id',$id );
           
           $update2->getResult();

           $contador = $contador+1;
          }
		  		//$consulta->getResult();
	 }

	public function findRowsrand($tipo)
	{
		$em = $this->getEntityManager();

		$consulta = $em->createQuery('
				SELECT s 
				FROM App:Images s
				WHERE s.tipo = :tipo AND s.incluido = :incluido
			   ORDER BY rand()');
				$consulta->setParameter('tipo', $tipo);
				$consulta->setParameter('incluido', 'si');

		  		return $consulta->getResult();
	 }

   public function findUpdateorder($idarray)
	{
		$em = $this->getEntityManager();

       $count = 1;
        foreach ($idarray as $id){

       $update = $em->createQuery('
            UPDATE App:Images s
            SET s.imgorder = :imgorder
            WHERE s.id = :id
            ');
            $update->setParameter('imgorder', $count);
            $update->setParameter('id', $id);
            $update->getResult();

            $count ++;
        }
        return TRUE;      
	 }



}
