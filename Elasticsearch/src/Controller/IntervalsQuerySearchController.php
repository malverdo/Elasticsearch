<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IntervalsQuerySearchController extends AbstractController
{
    /**
     * @Route("/intervals/query/search", name="intervals_query_search")
     */
    public function index(): Response
    {
        return $this->render('intervals_query_search/index.html.twig', [
            'controller_name' => 'IntervalsQuerySearchController',
        ]);
    }
}
