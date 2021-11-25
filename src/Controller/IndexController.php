<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @Route("/", name="app_index")
     */
    public function index(): JsonResponse
    {
        return new JsonResponse(['success' => false, 'message' => 'Invalid route.'], Response::HTTP_METHOD_NOT_ALLOWED);
    }
}
