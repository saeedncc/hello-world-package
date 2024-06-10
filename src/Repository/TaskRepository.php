<?php

namespace App\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;

use App\Entity\Task;
use App\Entity\Trip;
use App\Pagination\Paginator;

/**
 * @extends ServiceEntityRepository
 */
class TaskRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Task::class);
    }
	
	
	public function save(Task $item): void
    {
        $entityManager = $this->getEntityManager();
		
		$entityManager->persist($item);
		
        $entityManager->flush();

        return;
    }
	
	
	public function remove(Task $item): void
    {
        $entityManager = $this->getEntityManager();
		
        $entityManager->remove($item);
		
        $entityManager->flush();

        return;
    }
	
	
	public function getTrip(int $id): ?Trip
    {
		
		$repository=$this->getEntityManager()->getRepository(Trip::class);
		
        return $repository->find($id);

    }
	
	
	public function findAllTaskNoAssign()
    {
          return $this->createQueryBuilder('p')
               ->select('p.id,p.title')
               ->where('p.trip is null')
			   ->orderBy('p.title', 'ASC')
               ->getQuery()
               ->getResult()
           ;

      
    }

   
}
