<?php

namespace App\Controller\QueryDSL\CompoundQueries;

use App\Service\CreateClientElasticSearch;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BooleanQuerySearchController extends AbstractController
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
     * @Route("/boolean/query/search", name="boolean_query_search")
     */
    public function index(): Response
    {

        $client = $this->clientElasticSearch;
        $params = [
            'index' => 'card_index',
            'track_total_hits' => true,
            'size' => 21,
            'body' => [
                'query' => [
                    'bool' => [
                        "_name" => "testBB",
                        "must" => [
                            "term" => ["_doc.type" => "wally"]
                        ],
                        "filter" => [
                            'terms' => ['_doc.ban' => [true], "_name" => "testAA"]

                        ],
                        "must_not" => [
                            "range" => [
                                "_doc.roleId" => ["gte" => 2, "lte" => 5]
                            ]
                        ],
                        'should' => [
                            ['terms' => ['_doc.price' => [277,222]]],
                        ],
                        "minimum_should_match" => 1
                    ]

                ],
                "aggs" => [
                    "terms_roleId" => [
                        "terms" => [
                            "field" => '_doc.price',
                            'min_doc_count' => 2,
                            "max_doc_count" =>  3
                        ]
                    ]
                ]
            ]
        ];
        $response = $client->search($params);

        dd($response);

        return $this->render('boolean_query_search/index.html.twig', [
            'controller_name' => 'BooleanQuerySearchController',
        ]);
    }
}
