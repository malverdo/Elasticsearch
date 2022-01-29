<?php

namespace App\Controller\SearchYourData;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PaginateSearchController extends AbstractController
{
    /**
     * @Route("/paginate/search", name="paginate_search")
     */
    public function index(): Response
    {
        return $this->render('paginate_search/index.html.twig', [
            'controller_name' => 'PaginateSearchController',
        ]);
    }
}
