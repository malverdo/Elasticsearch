<?php

namespace App\Controller\SetData;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ElasticSearchSetPercolatorCarsController extends AbstractController
{
    /**
     * @Route("/elastic/search/set/percolator/cars", name="elastic_search_set_percolator_cars")
     */
    public function index(): Response
    {
        return $this->render('elastic_search_set_percolator_cars/index.html.twig', [
            'controller_name' => 'ElasticSearchSetPercolatorCarsController',
        ]);
    }
}
