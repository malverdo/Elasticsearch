<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SearchElasticFilterController extends AbstractController
{
    /**
     * @Route("/search/elastic/filter", name="search_elastic_filter")
     */
    public function index(): Response
    {
        return $this->render('search_elastic_filter/index.html.twig', [
            'controller_name' => 'SearchElasticFilterController',
        ]);
    }
}
