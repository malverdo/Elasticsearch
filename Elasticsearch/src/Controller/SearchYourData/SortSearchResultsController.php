<?php

namespace App\Controller\SearchYourData;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SortSearchResultsController extends AbstractController
{
    /**
     * @Route("/sort/search/results", name="sort_search_results")
     */
    public function index(): Response
    {
        return $this->render('sort_search_results/index.html.twig', [
            'controller_name' => 'SortSearchResultsController',
        ]);
    }
}
