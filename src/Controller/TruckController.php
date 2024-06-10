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

use App\Entity\Truck;
use App\Repository\TruckRepository;




#[Route("/api", "api.trucks.",format: "json")]
class TruckController extends AbstractController
{
   #[Route('/trucks', 'index', methods: ["GET"])]
	public function index(TruckRepository $repository, Request $request): JsonResponse
	{
		try {

			$items = $repository->findAllItems();

			return $this->json(['state'=>1,'result'=>$items],Response::HTTP_OK);
			
		} catch(Exception $e) {
			throw new BadRequestHttpException($e->getMessage());
		}
	}
	
	
	#[Route("/trucks/{id}", "show", methods: ["GET"])]
	public function show(Truck $item): JsonResponse
	{
		return $this->json($item);
	}
	
	
	#[Route("/trucks", "store", methods: ["POST"])]
	public function store(Request $request, TruckRepository $repository, ValidatorInterface $validator, BaseOptionsResolver $optionsResolver): JsonResponse
	{
		try {
			$requestBody = json_decode($request->getContent(), true);

			$params = $optionsResolver->configureTitle(true)->resolve($requestBody);
			
			$item = new Truck();
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
	
	
		

	#[Route("/trucks/{id}", "update", methods: ["PATCH", "PUT"])]
	public function update(Truck $item, Request $request, TruckRepository $repository, ValidatorInterface $validator, BaseOptionsResolver $optionsResolver) : JsonResponse
	{
		try {
			$isPatchMethod = $request->getMethod() === "PUT";
			$requestBody = json_decode($request->getContent(), true);

			$params = $optionsResolver
				->configureTitle($isPatchMethod)
				->resolve($requestBody);

			foreach($params as $key => $value) {
				switch($key) {
					case "title":
						$item->setTitle($value);
						break;
				}
			}

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
	
	
	#[Route("/trucks/{id}", "delete", methods: ["DELETE"])]
	public function delete(Truck $item, TruckRepository $repository) : JsonResponse
	{
		 $repository->remove($item);
		 
		 return $this->json(null, Response::HTTP_NO_CONTENT);
	}
	
	
}
