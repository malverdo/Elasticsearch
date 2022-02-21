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
                    'range' => [
                        'date_range' => [
//                            'field' => '_doc.dateTimeThisMonth.date',
//                            'format' => "epoch_second",
//                            'ranges' => [
//                                ['to'=> 1645164097],
//                                ['from'=> 1645164098]
//                            ]
                            'field' => '_doc.dateTimeRegistrationCard.date',
                            'format' => "yyyy-MM-dd HH:mm:ss.SSSSSS",
                            'ranges' => [
                                ['to'=> 'now-310M/M'],
                                ['from'=> 'now-309M/M']
                            ]
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
