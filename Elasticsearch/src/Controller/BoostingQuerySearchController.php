<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BoostingQuerySearchController extends AbstractController
{
    /**
     * @Route("/boosting/query/search", name="boosting_query_search")
     */
    public function index(): Response
    {
        return $this->render('boosting_query_search/index.html.twig', [
            'controller_name' => 'BoostingQuerySearchController',
        ]);
    }
}
