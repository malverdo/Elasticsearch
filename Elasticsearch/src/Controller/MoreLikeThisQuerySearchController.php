<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MoreLikeThisQuerySearchController extends AbstractController
{
    /**
     * @Route("/more/like/this/query/search", name="more_like_this_query_search")
     */
    public function index(): Response
    {
        return $this->render('more_like_this_query_search/index.html.twig', [
            'controller_name' => 'MoreLikeThisQuerySearchController',
        ]);
    }
}
