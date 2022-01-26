<?php

namespace App\Controller\SearchYourData;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CollapseSearchResultsController extends AbstractController
{



    /**
     * @Route("/collapse/search/results", name="collapse_search_results")
     */
    public function index(): Response
    {


        return $this->render('collapse_search_results/index.html.twig', [
            'controller_name' => 'CollapseSearchResultsController',
        ]);
    }
}
