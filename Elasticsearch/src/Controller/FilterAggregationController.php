<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FilterAggregationController extends AbstractController
{
    /**
     * @Route("/filter/aggregation", name="filter_aggregation")
     */
    public function index(): Response
    {
        return $this->render('filter_aggregation/index.html.twig', [
            'controller_name' => 'FilterAggregationController',
        ]);
    }
}
