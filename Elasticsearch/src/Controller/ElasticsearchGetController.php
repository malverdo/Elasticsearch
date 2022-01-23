<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ElasticsearchGetController extends AbstractController
{
    /**
     * @Route("/elasticsearch/get", name="elasticsearch_get")
     */
    public function index(): Response
    {
        return $this->render('elasticsearch_get/index.html.twig', [
            'controller_name' => 'ElasticsearchGetController',
        ]);
    }
}
