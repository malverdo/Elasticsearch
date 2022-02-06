<?php

namespace App\Controller\QueryDSL\FullTextQueries;

use App\Service\CreateClientElasticSearch;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IntervalsQuerySearchController extends AbstractController
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
     * @Route("/intervals/query/search", name="intervals_query_search")
     */
    public function index(): Response
    {

        $client = $this->clientElasticSearch;
        $params = [
            'index' => 'card_index',
            'track_total_hits' => true,
            'size' => 51,
            'body' => [
                'query' => [
                    "intervals" => [
                        "_doc.data.aboutMe" => [
                            "all_of" => [
                                "ordered" => false,
                                "intervals"=> [
                                [
                                    "match"=> [
                                    "query"=> "Qui",
                                        "max_gaps"=> 0,
                                        "ordered"=> true
                                    ]
                                ],
                                [
                                    "any_of"=> [
                                    "intervals"=> [
                                            [
                                                "match"=> [
                                                    "query"=> "consequatur"
                                                ]
                                            ]
                                        ]
                                    ]
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

        return $this->render('intervals_query_search/index.html.twig', [
            'controller_name' => 'IntervalsQuerySearchController',
        ]);
    }
}
