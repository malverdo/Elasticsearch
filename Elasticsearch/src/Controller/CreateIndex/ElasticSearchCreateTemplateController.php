<?php

namespace App\Controller\CreateIndex;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ElasticSearchCreateTemplateController extends AbstractController
{
    /**
     * @Route("/elastic/search/create/template", name="elastic_search_create_template")
     */
    public function index(): Response
    {
        return $this->render('elastic_search_create_template/index.html.twig', [
            'controller_name' => 'ElasticSearchCreateTemplateController',
        ]);
    }
}
