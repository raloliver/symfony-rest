<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;

class HelloPHPController
{
    /**
     * @Route("/hello")
     */
    public function helloPHPAction()
    {
        echo 'Hello again PHP!';
        exit();
    }
}
