<?php

namespace App\Controller\Aggregations\BucketAggregations;

use App\Service\CreateClientElasticSearch;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FilterAggregationController extends AbstractController
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
     * @Route("/filter/aggregation", name="filter_aggregation")
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

                ]
            ]
        ];
        $response = $client->search($params);
        dd($response);

        return $this->render('filter_aggregation/index.html.twig', [
            'controller_name' => 'FilterAggregationController',
        ]);
    }
}
