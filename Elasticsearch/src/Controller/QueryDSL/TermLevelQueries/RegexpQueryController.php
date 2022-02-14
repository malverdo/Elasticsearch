<?php

namespace App\Controller\QueryDSL\TermLevelQueries;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RegexpQueryController extends AbstractController
{
    /**
     * @Route("/regexp/query", name="regexp_query")
     */
    public function index(): Response
    {
        return $this->render('regexp_query/index.html.twig', [
            'controller_name' => 'RegexpQueryController',
        ]);
    }
}
