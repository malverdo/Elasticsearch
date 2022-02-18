<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CompositeAggregationController extends AbstractController
{
    /**
     * @Route("/composite/aggregation", name="composite_aggregation")
     */
    public function index(): Response
    {
        return $this->render('composite_aggregation/index.html.twig', [
            'controller_name' => 'CompositeAggregationController',
        ]);
    }
}
