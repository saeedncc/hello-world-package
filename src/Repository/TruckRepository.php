<?php

namespace App\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

use App\Entity\Truck;
use App\Pagination\Paginator;

/**
 * @extends ServiceEntityRepository
 */
class TruckRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Truck::class);
    }
	
	
	public function save(Truck $item): void
    {
        $entityManager = $this->getEntityManager();
		
		$entityManager->persist($item);
		
        $entityManager->flush();

        return;
    }
	
	
	public function remove(Truck $item): void
    {
        $entityManager = $this->getEntityManager();
		
        $entityManager->remove($item);
		
        $entityManager->flush();

        return;
    }
	
	public function findAllItems()
    {
          return $this->createQueryBuilder('p')
               ->select('p.id,p.title')
			   ->orderBy('p.title', 'ASC')
               ->getQuery()
               ->getResult()
           ;

      
    }

   
}
