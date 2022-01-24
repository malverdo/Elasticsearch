<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SearchElasticMatchController extends AbstractController
{
    /**
     * @Route("/search/elastic/match", name="search_elastic_match")
     */
    public function index(): Response
    {
        return $this->render('search_elastic_match/index.html.twig', [
            'controller_name' => 'SearchElasticMatchController',
        ]);
    }
}
