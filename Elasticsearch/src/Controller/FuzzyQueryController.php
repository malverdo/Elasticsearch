<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FuzzyQueryController extends AbstractController
{
    /**
     * @Route("/fuzzy/query", name="_fuzzy_query")
     */
    public function index(): Response
    {
        return $this->render('Аfuzzy_query/index.html.twig', [
            'controller_name' => 'АFuzzyQueryController',
        ]);
    }
}
