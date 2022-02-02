<?php

namespace App\Controller\SearchYourData;

use App\Service\CreateClientElasticSearch;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SortSearchResultsController extends AbstractController
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
     * @Route("/sort/search/results", name="sort_search_results")
     */
    public function index(): Response
    {

        $client = $this->clientElasticSearch;
        $params = [
            'index' => 'card_index',
            'track_total_hits' => true,
            'body'  => [
                'query' => [
                    'term' => [
                        '_doc.product' =>  'chocolate'
                    ]
                ],
                'sort' => [
                    '_doc.price' => [
                        'order' => 'asc',
                        'mode' => 'avg'
                    ],
//                    '_doc.dateTimeThisMonth.date' => [
//                        'order' => 'asc',
//                        "format" => "strict_date_optional_time_nanos"
//                    ]
                ]
            ]
        ];
        $response = $client->search($params);

        dd($response);

        return $this->render('sort_search_results/index.html.twig', [
            'controller_name' => 'SortSearchResultsController',
        ]);
    }
}
