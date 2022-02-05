<?php

namespace App\Controller\QueryDSL\CompoundQueries;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ConstantScoreQuerySearchController extends AbstractController
{
    /**
     * @Route("/constant/score/query/search", name="constant_score_query_search")
     */
    public function index(): Response
    {
        return $this->render('constant_score_query_search/index.html.twig', [
            'controller_name' => 'ConstantScoreQuerySearchController',
        ]);
    }
}
