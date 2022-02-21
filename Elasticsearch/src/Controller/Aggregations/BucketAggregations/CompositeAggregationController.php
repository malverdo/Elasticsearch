<?php

namespace App\Controller\Aggregations\BucketAggregations;

use App\Service\CreateClientElasticSearch;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CompositeAggregationController extends AbstractController
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
     * @Route("/composite/aggregation", name="composite_aggregation")
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
                            // TODO Composite aggregation
                        ]
                    ]
                ]
            ]
        ];
        $response = $client->search($params);

        dd($response);

        return $this->render('composite_aggregation/index.html.twig', [
            'controller_name' => 'CompositeAggregationController',
        ]);
    }
}
