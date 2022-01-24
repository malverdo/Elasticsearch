<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SearchElasticMustController extends AbstractController
{
    /**
     * @Route("/search/elastic/must", name="search_elastic_must")
     */
    public function index(): Response
    {
        return $this->render('search_elastic_must/index.html.twig', [
            'controller_name' => 'SearchElasticMustController',
        ]);
    }
}
