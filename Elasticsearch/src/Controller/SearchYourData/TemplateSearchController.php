<?php

namespace App\Controller\SearchYourData;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TemplateSearchController extends AbstractController
{
    /**
     * @Route("/template/search", name="template_search")
     */
    public function index(): Response
    {
        return $this->render('template_search/index.html.twig', [
            'controller_name' => 'TemplateSearchController',
        ]);
    }
}
