<?php

namespace App\Controller\Aggregations\BucketAggregations\Histogram;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HistogramAggregationController extends AbstractController
{
    /**
     * @Route("/histogram/aggregation", name="histogram_aggregation")
     */
    public function index(): Response
    {
        return $this->render('histogram_aggregation/index.html.twig', [
            'controller_name' => 'HistogramAggregationController',
        ]);
    }
}
