<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SearchElasticAggsController extends AbstractController
{
    /**
     * @Route("/search/elastic/aggs", name="search_elastic_aggs")
     */
    public function index(): Response
    {
        return $this->render('search_elastic_aggs/index.html.twig', [
            'controller_name' => 'SearchElasticAggsController',
        ]);
    }
}
