<?php

namespace App\Controller\SearchYourData;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HighlightingSearchController extends AbstractController
{
    /**
     * @Route("/highlighting/search", name="highlighting_search")
     */
    public function index(): Response
    {
        return $this->render('highlighting_search/index.html.twig', [
            'controller_name' => 'HighlightingSearchController',
        ]);
    }
}
