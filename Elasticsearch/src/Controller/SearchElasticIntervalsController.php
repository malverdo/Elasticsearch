<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SearchElasticIntervalsController extends AbstractController
{
    /**
     * @Route("/search/elastic/intervals", name="search_elastic_intervals")
     */
    public function index(): Response
    {
        return $this->render('search_elastic_intervals/index.html.twig', [
            'controller_name' => 'SearchElasticIntervalsController',
        ]);
    }
}
