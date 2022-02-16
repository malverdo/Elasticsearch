<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdjacencyMatrixAggregationController extends AbstractController
{
    /**
     * @Route("/adjacency/matrix/aggregation", name="adjacency_matrix_aggregation")
     */
    public function index(): Response
    {
        return $this->render('adjacency_matrix_aggregation/index.html.twig', [
            'controller_name' => 'AdjacencyMatrixAggregationController',
        ]);
    }
}
