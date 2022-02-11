<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ExistsQueryController extends AbstractController
{
    /**
     * @Route("/exists/query", name="exists_query")
     */
    public function index(): Response
    {
        return $this->render('exists_query/index.html.twig', [
            'controller_name' => 'ExistsQueryController',
        ]);
    }
}
