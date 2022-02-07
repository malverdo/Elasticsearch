<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ESController extends AbstractController
{
    /**
     * @Route("/e/s", name="e_s")
     */
    public function index(): Response
    {
        return $this->render('es/index.html.twig', [
            'controller_name' => 'ESController',
        ]);
    }
}
