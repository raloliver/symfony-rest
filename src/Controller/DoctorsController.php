<?php

namespace App\Controller;

use App\Entity\Doctor;
use App\Helper\DoctorFactory;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DoctorsController extends AbstractController
{

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var DoctorFactory
     */
    private $doctrine;

    /**
     * @var DoctorFactory
     */
    private $doctorFactory;

    public function __construct(
        EntityManagerInterface $entityManagerInterface,
        ManagerRegistry $managerRegistry,
        DoctorFactory $doctorFactory
    ) {
        $this->entityManager = $entityManagerInterface;
        $this->doctrine = $managerRegistry;
        $this->doctorFactory = $doctorFactory;
    }

    /**
     * @Route("/doctors", methods={"POST"})
     */
    public function add(Request $request): Response
    {
        $requestBody = $request->getContent();
        $doctor = $this->doctorFactory->createDoctor($requestBody);

        //watching and managing the entity
        $this->entityManager->persist($doctor);
        //push the data to DB
        $this->entityManager->flush();

        //JsonResponse give to client more data at header about the response
        return new JsonResponse($doctor);
    }

    /**
     * @Route("/doctors", methods={"GET"})
     */
    public function getAll(): Response
    {
        $doctorsRepository = $this->doctrine->getRepository(Doctor::class);
        $allDoctors = $doctorsRepository->findAll();

        return new JsonResponse($allDoctors);
    }

    /**
     * @Route("/doctors/{doctorId}", methods={"GET"})
     */
    public function getById(int $doctorId): Response
    {
        $doctorById = $this->getDoctorById($doctorId);
        $statusCode = is_null($doctorById) ? Response::HTTP_NO_CONTENT : 200;

        return new JsonResponse($doctorById, $statusCode);
    }

    /**
     * @Route("/doctors/{doctorId}", methods={"PUT"})
     */
    public function updateById(int $doctorId, Request $request): Response
    {
        $requestBody = $request->getContent();
        $doctor = $this->doctorFactory->createDoctor($requestBody);

        $doctorById = $this->getDoctorById($doctorId);

        if (is_null($doctorById)) {
            return new Response('', Response::HTTP_NOT_FOUND);
        }

        $doctorById->crm = $doctor->crm;
        $doctorById->fullName = $doctor->fullName;

        //we dont need to watch the entity cause it is already watched when was find
        $this->entityManager->flush();

        return new JsonResponse($doctorById);
    }

    public function getDoctorById(int $doctorId): Doctor
    {
        $doctorsRepository = $this->doctrine->getRepository(Doctor::class);
        $doctorById = $doctorsRepository->find($doctorId);

        return $doctorById;
    }
}
