<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WrapperQueryController extends AbstractController
{
    /**
     * @Route("/wrapper/query", name="wrapper_query")
     */
    public function index(): Response
    {
        return $this->render('wrapper_query/index.html.twig', [
            'controller_name' => 'WrapperQueryController',
        ]);
    }
}
