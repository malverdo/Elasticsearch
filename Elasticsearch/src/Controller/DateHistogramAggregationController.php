<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DateHistogramAggregationController extends AbstractController
{
    /**
     * @Route("/date/histogram/aggregation", name="date_histogram_aggregation")
     */
    public function index(): Response
    {
        return $this->render('date_histogram_aggregation/index.html.twig', [
            'controller_name' => 'DateHistogramAggregationController',
        ]);
    }
}
