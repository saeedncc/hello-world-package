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

use App\Entity\Task;
use App\Repository\TaskRepository;
use App\Repository\TripRepository;




#[Route("/api", "api.tasks.",format: "json")]
class TaskController extends AbstractController
{
   #[Route('/tasks', 'index', methods: ["GET"])]
	public function index(TaskRepository $repository, Request $request): JsonResponse
	{
		try {
			
			$items = $repository->findAllTaskNoAssign();
			return $this->json(['state'=>1,'result'=>$items],Response::HTTP_OK);
			
		} catch(Exception $e) {
			throw new BadRequestHttpException($e->getMessage());
		}
	}
	
	
	#[Route("/tasks/{id}", "show", methods: ["GET"])]
	public function show(Task $item): JsonResponse
	{
		return $this->json($item);
	}
	
	
	#[Route("/tasks", "store", methods: ["POST"])]
	public function store(Request $request, TaskRepository $repository, ValidatorInterface $validator, BaseOptionsResolver $optionsResolver): JsonResponse
	{
		try {
			$requestBody = json_decode($request->getContent(), true);

			$params = $optionsResolver
				->configureTitle(true)
				->resolve($requestBody);
				
			$item = new Task();
			$item->setTitle($params["title"]);
			
			
			$errors = $validator->validate($item);
			if (count($errors)>0) {
				throw new InvalidArgumentException((string) $errors);
			}
				

			$repository->save($item);

			return $this->json($item, status: Response::HTTP_CREATED);
			
		} catch(Exception $e) {
			throw new BadRequestHttpException($e->getMessage());
		}
	}
	
	
		

	#[Route("/tasks/{id}", "update", methods: ["PATCH", "PUT"])]
	public function update(Task $item, Request $request, TaskRepository $repository, ValidatorInterface $validator, BaseOptionsResolver $optionsResolver) : JsonResponse
	{
		try {
			$requestBody = json_decode($request->getContent(), true);

			$params = $optionsResolver
				->configureTitle(true)
				->resolve($requestBody);
				

			$item->setTitle($params["title"]);
			
			
			$errors = $validator->validate($item);
			if (count($errors)>0) {
				throw new InvalidArgumentException((string) $errors);
			}

			$repository->save($item);

			return $this->json($item);
			
		} catch(Exception $e) {
			throw new BadRequestHttpException($e->getMessage());
		}
	}
	
	
	#[Route("/tasks/{id}/assign", "assign", methods: ["PATCH", "PUT"])]
	public function assign(Task $item, Request $request, TaskRepository $repository,TripRepository $tripRepository, ValidatorInterface $validator, BaseOptionsResolver $optionsResolver) : JsonResponse
	{
		try {
			$requestBody = json_decode($request->getContent(), true);

			$params = $optionsResolver
				->configureTripId(true)
				->resolve($requestBody);
			
			
			$errors = $validator->validate($item);
			if (count($errors)>0) {
				throw new InvalidArgumentException((string) $errors);
			}


			$trip=$repository->getTrip($params['trip_id']);
			if($trip==null){
				throw new InvalidArgumentException('there is no trip');
			}
			$item->setTrip($trip);

			$repository->save($item);

			
			$tasks=$tripRepository->getTasks($params['trip_id']);

			return $this->json(['state'=>1,'result'=>['id'=>$item->getId(),'trip_id'=>$params['trip_id'],'tasks'=>$tasks]],Response::HTTP_OK);
			
		} catch(Exception $e) {
			throw new BadRequestHttpException($e->getMessage());
		}
	}
	
	
	#[Route("/tasks/{id}", "delete", methods: ["DELETE"])]
	public function delete(Task $item, TaskRepository $repository) : JsonResponse
	{
		 $repository->remove($item);
		 
		 return $this->json(null, Response::HTTP_NO_CONTENT);
	}
	
	
}
