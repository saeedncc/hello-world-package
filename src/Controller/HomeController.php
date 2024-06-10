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



class HomeController extends AbstractController
{
   #[Route('/', 'home', methods: ["GET"])]
	public function index(Request $request): Response
	{
		return $this->render('trip/trip.html.twig');
	}
}
