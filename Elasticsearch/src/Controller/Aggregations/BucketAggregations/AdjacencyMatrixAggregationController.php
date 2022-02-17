<?php

namespace App\Controller\Aggregations\BucketAggregations;

use App\Service\CreateClientElasticSearch;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdjacencyMatrixAggregationController extends AbstractController
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
     * @Route("/adjacency/matrix/aggregation", name="adjacency_matrix_aggregation")
     */
    public function index(): Response
    {

        $client = $this->clientElasticSearch;
        $params = [
            'index' => 'card_index',
            'track_total_hits' => true,
            'size' => 51,
            'body' => [
                'aggs' => [
                    'interactions' => [
                        'adjacency_matrix' => [
                            'filters' => [
                                'grpA' => [
                                    'terms' => [
                                        '_doc.offer.color' => ['DarkSlateBlue']
                                    ]
                                ],
                                'grpB' => [
                                    'terms' => [
                                        '_doc.offer.color' => ['PaleVioletRed']
                                    ]
                                ],
                                'grpC' => [
                                    'terms' => [
                                        '_doc.offer.color' => ['SlateGray']
                                    ]
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ];
        $response = $client->search($params);

        dd($response);

        return $this->render('adjacency_matrix_aggregation/index.html.twig', [
            'controller_name' => 'AdjacencyMatrixAggregationController',
        ]);
    }
}
