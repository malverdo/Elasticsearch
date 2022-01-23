<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ElasticsearchSetController extends AbstractController
{
    /**
     * @Route("/elasticsearch/set", name="elasticsearch_set")
     */
    public function index(): Response
    {


        return $this->render('elasticsearch_set/index.html.twig', [
            'controller_name' => 'ElasticsearchSetController',
        ]);
    }
}
