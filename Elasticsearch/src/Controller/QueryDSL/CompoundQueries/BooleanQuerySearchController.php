<?php

namespace App\Controller\QueryDSL\CompoundQueries;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BooleanQuerySearchController extends AbstractController
{
    /**
     * @Route("/boolean/query/search", name="boolean_query_search")
     */
    public function index(): Response
    {
        return $this->render('boolean_query_search/index.html.twig', [
            'controller_name' => 'BooleanQuerySearchController',
        ]);
    }
}
