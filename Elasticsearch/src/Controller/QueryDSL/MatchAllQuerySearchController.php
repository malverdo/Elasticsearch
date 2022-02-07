<?php

namespace App\Controller\QueryDSL;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MatchAllQuerySearchController extends AbstractController
{
    /**
     * @Route("/match/all/query/search", name="match_all_query_search")
     */
    public function index(): Response
    {
        return $this->render('match_all_query_search/index.html.twig', [
            'controller_name' => 'MatchAllQuerySearchController',
        ]);
    }
}
