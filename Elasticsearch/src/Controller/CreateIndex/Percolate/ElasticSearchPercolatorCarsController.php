<?php

namespace App\Controller\CreateIndex\Percolate;

use App\Service\CreateClientElasticSearch;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ElasticSearchPercolatorCarsController extends AbstractController
{

    /**
     * @var CreateClientElasticSearch
     */
    private $clientElasticSearch;


    /**
     * @param CreateClientElasticSearch $clientElasticSearch
     */
    public function __construct(
        CreateClientElasticSearch $clientElasticSearch
    ) {
        $this->clientElasticSearch = $clientElasticSearch;
    }

    /**
     * @Route("/elastic/search/percolator/cars", name="elastic_search_percolator_cars")
     */
    public function index(): Response
    {

        $client = $this->clientElasticSearch->getClient();
        $params = [
            'index' => 'index_percolator_cars',
            'body' => [
                'mappings' => [
                    'properties' => [
                        "query" => [
                            "type" => "percolator"
                        ],
                        "brand" => ["type" => "keyword"],
                        "model" => ["type" => "keyword"],
                        "price" => ["type" => "long"]
                    ]
                ],
                'settings' => [
                    'number_of_shards' => 2,
                    'number_of_replicas' => 0
                ]

            ]

        ];

        $response = $client->indices()->create($params);

        return $this->render('elastic_search_percolator_cars/index.html.twig', [
            'controller_name' => 'ElasticSearchPercolatorCarsController',
        ]);
    }
}
