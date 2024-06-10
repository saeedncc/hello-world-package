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

use App\Entity\Driver;
use App\Repository\DriverRepository;




#[Route("/api", "api.drivers.",format: "json")]
class DriverController extends AbstractController
{
   #[Route('/drivers', 'index', methods: ["GET"])]
	public function index(DriverRepository $repository, Request $request): JsonResponse
	{
		try {

			$items = $repository->findAllItems();

			return $this->json(['state'=>1,'result'=>$items],Response::HTTP_OK);
			
		} catch(Exception $e) {
			throw new BadRequestHttpException($e->getMessage());
		}
	}
	
	
	#[Route("/drivers/{id}", "show", methods: ["GET"])]
	public function show(Driver $item): JsonResponse
	{
		return $this->json($item);
	}
	
	
	#[Route("/drivers", "store", methods: ["POST"])]
	public function store(Request $request, DriverRepository $repository, ValidatorInterface $validator, BaseOptionsResolver $optionsResolver): JsonResponse
	{
		try {
			$requestBody = json_decode($request->getContent(), true);

			$params = $optionsResolver->configureFullname(true)->resolve($requestBody);
			
			$item = new Driver();
			$item->setFullname($params["fullname"]);

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
	
	
		

	#[Route("/drivers/{id}", "update", methods: ["PATCH", "PUT"])]
	public function update(Driver $item, Request $request, DriverRepository $repository, ValidatorInterface $validator, BaseOptionsResolver $optionsResolver) : JsonResponse
	{
		try {
			$isPatchMethod = $request->getMethod() === "PUT";
			$requestBody = json_decode($request->getContent(), true);

			$params = $optionsResolver
				->configureFullname($isPatchMethod)
				->resolve($requestBody);

			foreach($params as $key => $value) {
				switch($key) {
					case "fullname":
						$item->setFullname($value);
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
	
	
	#[Route("/drivers/{id}", "delete", methods: ["DELETE"])]
	public function delete(Driver $item, DriverRepository $repository) : JsonResponse
	{
		 $repository->remove($item);
		 
		 return $this->json(null, Response::HTTP_NO_CONTENT);
	}
	
	
}
