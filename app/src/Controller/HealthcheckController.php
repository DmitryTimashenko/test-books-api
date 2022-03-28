<?php

namespace App\Controller;

use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations;
use Symfony\Component\HttpFoundation\JsonResponse;

class HealthcheckController extends AbstractFOSRestController
{
    #[Annotations\Get(path: "/ping")]
    public function getAction()
    {
        return new JsonResponse('pong');
    }
}