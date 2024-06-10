<?php

namespace App\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;

use App\Entity\Trip;
use App\Entity\Driver;
use App\Entity\Truck;
use App\Entity\Task;
use App\Pagination\Paginator;

/**
 * @extends ServiceEntityRepository
 */
class TripRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Trip::class);
    }
	
	
	public function save(Trip $item): void
    {
        $entityManager = $this->getEntityManager();
		
		$entityManager->persist($item);
		
        $entityManager->flush();

        return;
    }
	
	
	public function remove(Trip $item): void
    {
        $entityManager = $this->getEntityManager();
		
        $entityManager->remove($item);
		
        $entityManager->flush();

        return;
    }
	
	
	public function getDriver(int $id): ?Driver
    {
		
		$repository=$this->getEntityManager()->getRepository(Driver::class);
		
        return $repository->find($id);

    }
	
	
	public function getTruck(int $id): ?Truck
    {
        $repository=$this->getEntityManager()->getRepository(Truck::class);
		
        return $repository->find($id);

    }
	
	
	public function getTasks(int $id)
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
            select id,title from task 
			
				where trip_id='.(int)$id.' 
            ';

        $resultSet = $conn->executeQuery($sql);
		
        return $resultSet->fetchAllAssociative();

    }
	
	
	public function findAllItems()
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
            SELECT trip.id,trip.title,trip.driver_id,trip.truck_id,driver.fullname as driver_fullname,truck.title as truck_title,
					(select group_concat(title) as tasks from task where trip_id=trip.id) as tasks
			FROM trip 
			INNER JOIN driver  ON driver.id=trip.driver_id
			INNER JOIN truck  ON truck.id=trip.truck_id
			
            ';

        $resultSet = $conn->executeQuery($sql);
		
        return $resultSet->fetchAllAssociative();

      
    }

   
}
