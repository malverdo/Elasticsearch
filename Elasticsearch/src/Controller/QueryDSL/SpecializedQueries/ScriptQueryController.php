<?php

namespace App\Controller\QueryDSL\SpecializedQueries;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ScriptQueryController extends AbstractController
{
    /**
     * @Route("/script/query", name="script_query")
     */
    public function index(): Response
    {
        return $this->render('script_query/index.html.twig', [
            'controller_name' => 'ScriptQueryController',
        ]);
    }
}
