<?php

namespace App\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

use App\Entity\Driver;
use App\Pagination\Paginator;

/**
 * @extends ServiceEntityRepository
 */
class DriverRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Driver::class);
    }
	
	
	public function save(Driver $item): void
    {
        $entityManager = $this->getEntityManager();
		
		$entityManager->persist($item);
		
        $entityManager->flush();

        return;
    }
	
	
	public function remove(Driver $item): void
    {
        $entityManager = $this->getEntityManager();
		
        $entityManager->remove($item);
		
        $entityManager->flush();

        return;
    }
	
	
	public function findAllItems()
    {
          return $this->createQueryBuilder('p')
               ->select('p.id,p.fullname')
			   ->orderBy('p.fullname', 'ASC')
               ->getQuery()
               ->getResult()
           ;

      
    }

   
}
