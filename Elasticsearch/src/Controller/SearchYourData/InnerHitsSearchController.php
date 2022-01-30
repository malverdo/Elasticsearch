<?php

namespace App\Controller\SearchYourData;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class InnerHitsSearchController extends AbstractController
{
    /**
     * @Route("/inner/hits/search", name="inner_hits_search")
     */
    public function index(): Response
    {
        return $this->render('inner_hits_search/index.html.twig', [
            'controller_name' => 'InnerHitsSearchController',
        ]);
    }
}
