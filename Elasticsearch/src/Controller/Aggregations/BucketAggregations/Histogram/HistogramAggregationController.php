<?php

namespace App\Controller\Aggregations\BucketAggregations\Histogram;

use App\Service\CreateClientElasticSearch;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HistogramAggregationController extends AbstractController
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
     * @Route("/histogram/aggregation", name="histogram_aggregation")
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
                            'field' => '_doc.number.value',
                            'interval' => 5,
                            "keyed" => true,
                            "min_doc_count" => 1,
//                            "offset" => 1,
//                            "missing" => 10,
                            //"order" => [ "_count" => "desc" ],
                            "order" => [ "_key" => "desc" ],
                            //"extended_bounds" => [
                            //    "min" => 0,
                            //    "max" => 1200
                            //]
                        ]
                    ]
                ]
            ]
        ];
        $response = $client->search($params);

        dd($response);

        return $this->render('histogram_aggregation/index.html.twig', [
            'controller_name' => 'HistogramAggregationController',
        ]);
    }
}
