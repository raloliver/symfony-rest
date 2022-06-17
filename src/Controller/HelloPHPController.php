<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HelloPHPController
{
    /**
     * @Route("/hello")
     */
    public function helloPHPAction(Request $request): Response
    {
        $pathInfo = $request->getPathInfo();
        $params = $request->query->all();

        return new JsonResponse([
            'message' => 'Hello again PHP!',
            'pathInfo' => $pathInfo,
            'params' => $params,
        ]);
    }
}
