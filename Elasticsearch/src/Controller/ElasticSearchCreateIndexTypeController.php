<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ElasticSearchCreateIndexTypeController extends AbstractController
{
    /**
     * @Route("/elastic/search/create/index/type", name="elastic_search_create_index_type")
     */
    public function index(): Response
    {
        return $this->render('elastic_search_create_index_type/index.html.twig', [
            'controller_name' => 'ElasticSearchCreateIndexTypeController',
        ]);
    }
}
