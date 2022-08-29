<?php

namespace App\Helper;

use App\Entity\Doctor;
use App\Repository\SpecialtyRepository;

class DoctorFactory
{
    private $specialtyRepository;

    public function __construct(SpecialtyRepository $specialtyRepository)
    {
        $this->specialtyRepository = $specialtyRepository;
    }

    public function createDoctor(string $json): Doctor
    {
        $JSON = json_decode($json);
        $specialtyId = $JSON->specialty;
        $specialty = $this->specialtyRepository->find($specialtyId);

        $doctor = new Doctor();
        $doctor
            ->setCrm($JSON->crm)
            ->setFullName($JSON->fullName)
            ->setSpecialty($specialty);

        return $doctor;
    }
}
