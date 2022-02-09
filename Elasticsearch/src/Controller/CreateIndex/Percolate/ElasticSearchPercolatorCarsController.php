<?php

namespace App\Controller\CreateIndex\Percolate;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ElasticSearchPercolatorCarsController extends AbstractController
{
    /**
     * @Route("/elastic/search/percolator/cars", name="elastic_search_percolator_cars")
     */
    public function index(): Response
    {
        return $this->render('elastic_search_percolator_cars/index.html.twig', [
            'controller_name' => 'ElasticSearchPercolatorCarsController',
        ]);
    }
}
