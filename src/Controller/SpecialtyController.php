<?php

namespace App\Controller;

use App\Entity\Specialty;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class SpecialtyController extends AbstractController
{

    public function __construct(
        EntityManagerInterface $entityManagerInterface,
    ) {
        $this->entityManager = $entityManagerInterface;
    }

    /**
     * @Route("/specialty", methods={"POST"})
     */
    public function add(Request $request): JsonResponse
    {
        $requestBody = $request->getContent();
        $requestBodyJSON = json_decode($requestBody);

        $specialty = new Specialty();
        $specialty->setDescription($requestBodyJSON->description);

        $this->entityManager->persist($specialty);
        $this->entityManager->flush();

        return new JsonResponse($specialty);
    }
}
