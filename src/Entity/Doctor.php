<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 */
class Doctor
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    public $id;
    /**
     * @ORM\Column(type="integer")
     */
    public $crm;
    /**
     * @ORM\Column(type="string")
     */
    public $fullName;
}
