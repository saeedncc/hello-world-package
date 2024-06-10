<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use InvalidArgumentException;
use App\OptionsResolver\BaseOptionsResolver;

use App\Entity\Trip;
use App\Repository\TripRepository;




#[Route("/api", "api.trips.",format: "json")]
class TripController extends AbstractController
{
   #[Route('/trips', 'index', methods: ["GET"])]
	public function index(TripRepository $repository, Request $request): JsonResponse
	{
		try {

			$items = $repository->findAllItems();

			return $this->json(['state'=>1,'result'=>$items],Response::HTTP_OK);
			
		} catch(Exception $e) {
			throw new BadRequestHttpException($e->getMessage());
		}
	}
	
	
	#[Route("/trips/{id}", "show", methods: ["GET"])]
	public function show(Trip $item): JsonResponse
	{
		return $this->json($item);
	}
	
	
	#[Route("/trips", "store", methods: ["POST"])]
	public function store(Request $request, TripRepository $repository, ValidatorInterface $validator, BaseOptionsResolver $optionsResolver): JsonResponse
	{
		try {
			$requestBody = json_decode($request->getContent(), true);

			$params = $optionsResolver
				->configureTitle(true)
				->configureDriverId(true)
				->configureTruckId(true)
				->resolve($requestBody);
				
			$item = new Trip();
			$item->setTitle($params["title"]);
			
			
			$errors = $validator->validate($item);
			if (count($errors)>0) {
				throw new InvalidArgumentException((string) $errors);
			}

			$driver=$repository->getDriver($params['driver_id']);
			if($driver==null){
				throw new InvalidArgumentException('there is no driver');
			}
			$item->setDriver($driver);
			
			
			$truck=$repository->getTruck($params['truck_id']);
			if($truck==null){
				throw new InvalidArgumentException('there is no truck');
			}
			$item->setTruck($truck);
				

			$repository->save($item);
			
			$item=[
			'driver_fullname'=>$item->getDriver()->getFullname(),
			'driver_id'=>$item->getDriver()->getId(),
			'id'=>$item->getId(),
			'tasks'=>null,
			'title'=>$item->getTitle(),
			'truck_id'=>$item->getTruck()->getId(),
			'truck_title'=>$item->getTruck()->getTitle()
			];
			


			return $this->json(['state'=>1,'result'=>$item],Response::HTTP_CREATED);
			
		} catch(Exception $e) {
			throw new BadRequestHttpException($e->getMessage());
		}
	}
	
	
		

	#[Route("/trips/{id}", "update", methods: ["PATCH", "PUT"])]
	public function update(Trip $item, Request $request, TripRepository $repository, ValidatorInterface $validator, BaseOptionsResolver $optionsResolver) : JsonResponse
	{
		try {
			$requestBody = json_decode($request->getContent(), true);

			$params = $optionsResolver
				->configureTitle(true)
				->configureDriverId(false)
				->configureTruckId(false)
				->resolve($requestBody);
				

			$item->setTitle($params["title"]);
			
			
			$errors = $validator->validate($item);
			if (count($errors)>0) {
				throw new InvalidArgumentException((string) $errors);
			}

			if(isset($params['driver_id'])){
				$driver=$repository->getDriver($params['driver_id']);
				if($driver==null){
					throw new InvalidArgumentException('there is no driver');
				}
				$item->setDriver($driver);
			}
			
			if(isset($params['truck_id'])){
				$truck=$repository->getTruck($params['truck_id']);
				if($truck==null){
					throw new InvalidArgumentException('there is no truck');
				}
				$item->setTruck($truck);
			}
				

			$repository->save($item);

			return $this->json($item);
			
		} catch(Exception $e) {
			throw new BadRequestHttpException($e->getMessage());
		}
	}
	
	
	#[Route("/trips/{id}", "delete", methods: ["DELETE"])]
	public function delete(Trip $item, TripRepository $repository) : JsonResponse
	{
		 $repository->remove($item);
		 
		 return $this->json(null, Response::HTTP_NO_CONTENT);
	}
	
	
}
