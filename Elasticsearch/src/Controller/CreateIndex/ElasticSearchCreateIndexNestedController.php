<?php

namespace App\Controller\CreateIndex;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ElasticSearchCreateIndexNestedController extends AbstractController
{
    /**
     * @Route("/elastic/search/create/index/nested", name="elastic_search_create_index_nested")
     */
    public function index(): Response
    {
        return $this->render('elastic_search_create_index_nested/index.html.twig', [
            'controller_name' => 'ElasticSearchCreateIndexNestedController',
        ]);
    }
}
