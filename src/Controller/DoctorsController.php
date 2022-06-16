<?php

namespace App\Controller;

use App\Entity\Doctor;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DoctorsController
{

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManagerInterface)
    {
        $this->entityManager = $entityManagerInterface;
    }

    /**
     * @Route("/doctors", methods={"POST"})
     */
    public function add(Request $request): Response
    {
        $requestBody = $request->getContent();
        $requestBodyJSON = json_decode($requestBody);
        // var_dump($requestBodyDecode);
        // exit();

        $doctor = new Doctor();
        $doctor->crm = $requestBodyJSON->crm;
        $doctor->fullName = $requestBodyJSON->fullName;

        //watching and managing the entity
        $this->entityManager->persist($doctor);
        //push the data to DB
        $this->entityManager->flush();

        //JsonResponse give to client more data at header about the response
        return new JsonResponse($doctor);
    }
}
