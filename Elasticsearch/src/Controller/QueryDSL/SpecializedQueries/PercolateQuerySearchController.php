<?php

namespace App\Controller\QueryDSL\SpecializedQueries;

use App\Service\CreateClientElasticSearch;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PercolateQuerySearchController extends AbstractController
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
     * @Route("/percolate/query/search", name="percolate_query_search")
     */
    public function index(): Response
    {

        $client = $this->clientElasticSearch;
        $params = [
            'index' => 'index_percolator_cars',
            'track_total_hits' => true,
            'size' => 51,
            'body' => [
                'query' => [
                    'percolate' => [
                        "field" => "query",
                        "document" => [
                            "brand" => "Tesla",
                            "model" => 5,
                            "price" => 50000
                        ]
                    ]
                ]
            ]
        ];
        $response = $client->search($params);

        dd($response);

        return $this->render('percolate_query_search/index.html.twig', [
            'controller_name' => 'PercolateQuerySearchController',
        ]);
    }
}
