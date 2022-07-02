<?php

namespace App\Helper;

use App\Entity\Doctor;

class DoctorFactory
{
    public function createDoctor(string $json): Doctor
    {
        $JSON = json_decode($json);

        $doctor = new Doctor();
        $doctor->crm = $JSON->crm;
        $doctor->fullName = $JSON->fullName;

        return $doctor;
    }
}
