<?php

namespace App\Controller\Aggregations\BucketAggregations;

use App\Service\CreateClientElasticSearch;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DateRangeAggregationController extends AbstractController
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
     * @Route("/date/range/aggregation", name="date_range_aggregation")
     */
    public function index(): Response
    {

        $client = $this->clientElasticSearch;
        $params = [
            'index' => 'card_index',
            'track_total_hits' => true,
            'size' => 5,
            'body' => [
                'aggs' => [
                    'latency_buckets' => [
                        'histogram' => [

                        ]
                    ]
                ]
            ]
        ];
        $response = $client->search($params);

        dd($response);

        return $this->render('date_range_aggregation/index.html.twig', [
            'controller_name' => 'DateRangeAggregationController',
        ]);
    }
}
