<?php

namespace App\Controller\QueryDSL\TermLevelQueries;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TermsSetQueryController extends AbstractController
{
    /**
     * @Route("/terms/set/query", name="terms_set_query")
     */
    public function index(): Response
    {
        return $this->render('terms_set_query/index.html.twig', [
            'controller_name' => 'TermsSetQueryController',
        ]);
    }
}
