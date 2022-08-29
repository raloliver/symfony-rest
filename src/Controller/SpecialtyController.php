<?php

namespace App\Controller;

use App\Entity\Specialty;
use App\Repository\SpecialtyRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SpecialtyController extends AbstractController
{
    /**
     * @var SpecialtyRepository
     */
    private $specialtyRepository;

    public function __construct(
        EntityManagerInterface $entityManagerInterface,
        SpecialtyRepository $specialtyRepository
    ) {
        $this->entityManager = $entityManagerInterface;
        $this->specialtyRepository = $specialtyRepository;
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

    /**
     * @Route("/specialty", methods={"GET"})
     */
    public function getAll(): Response
    {
        $allSpecialties = $this->specialtyRepository->findAll();

        return new JsonResponse($allSpecialties);
    }

    /**
     * @Route("/specialty/{specialtyId}", methods={"GET"})
     */
    public function getById(int $specialtyId): Response
    {
        return new JsonResponse($this->specialtyRepository->find($specialtyId));
    }

    /**
     * @Route("/specialty/{specialtyId}", methods={"PUT"})
     */
    public function updateById(int $specialtyId, Request $request): Response
    {

        $requestBody = $request->getContent();
        $requestBodyJSON = json_decode($requestBody);

        $specialty = $this->specialtyRepository->find($specialtyId);
        $specialty->setDescription($requestBodyJSON->description);

        if (is_null($specialty)) {
            return new Response('', Response::HTTP_NOT_FOUND);
        }

        $this->entityManager->flush();

        return new JsonResponse($specialty);
    }

    /**
     * @Route("/specialty/{specialtyId}", methods={"DELETE"})
     */
    public function removeById(int $specialtyId): Response
    {
        $specialty = $this->specialtyRepository->find($specialtyId);
        $this->entityManager->remove($specialty);
        $this->entityManager->flush();

        return new Response('', Response::HTTP_NO_CONTENT);
    }
}
