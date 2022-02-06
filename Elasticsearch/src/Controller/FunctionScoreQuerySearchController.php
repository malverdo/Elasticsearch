<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FunctionScoreQuerySearchController extends AbstractController
{
    /**
     * @Route("/function/score/query/search", name="function_score_query_search")
     */
    public function index(): Response
    {
        return $this->render('function_score_query_search/index.html.twig', [
            'controller_name' => 'FunctionScoreQuerySearchController',
        ]);
    }
}
