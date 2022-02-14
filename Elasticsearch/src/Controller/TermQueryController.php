<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TermQueryController extends AbstractController
{
    /**
     * @Route("/term/query", name="term_query")
     */
    public function index(): Response
    {
        return $this->render('term_query/index.html.twig', [
            'controller_name' => 'TermQueryController',
        ]);
    }
}
