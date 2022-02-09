<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ElasticSearchCarsIndexController extends AbstractController
{
    /**
     * @Route("/elastic/search/cars/index", name="elastic_search_cars_index")
     */
    public function index(): Response
    {
        return $this->render('elastic_search_cars_index/index.html.twig', [
            'controller_name' => 'ElasticSearchCarsIndexController',
        ]);
    }
}
