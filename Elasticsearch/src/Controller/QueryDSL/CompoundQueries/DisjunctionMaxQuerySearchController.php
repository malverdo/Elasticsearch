<?php

namespace App\Controller\QueryDSL\CompoundQueries;

use App\Service\CreateClientElasticSearch;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DisjunctionMaxQuerySearchController extends AbstractController
{

    /**
     * @var CreateClientElasticSearch
     */
    private $clientElasticSearch;

    public function __construct(CreateClientElasticSearch $clientElasticSearch)
    {
        $this->clientElasticSearch = $clientElasticSearch->getClient();
    }

    /**
     * @Route("/disjunction/max/query/search", name="disjunction_max_query_search")
     */
    public function index(): Response
    {
        return $this->render('disjunction_max_query_search/index.html.twig', [
            'controller_name' => 'DisjunctionMaxQuerySearchController',
        ]);
    }
}
