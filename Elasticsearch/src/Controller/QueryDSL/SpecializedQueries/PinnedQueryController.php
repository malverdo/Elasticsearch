<?php

namespace App\Controller\QueryDSL\SpecializedQueries;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PinnedQueryController extends AbstractController
{
    /**
     * @Route("/pinned/query", name="pinned_query")
     */
    public function index(): Response
    {
        return $this->render('pinned_query/index.html.twig', [
            'controller_name' => 'PinnedQueryController',
        ]);
    }
}
