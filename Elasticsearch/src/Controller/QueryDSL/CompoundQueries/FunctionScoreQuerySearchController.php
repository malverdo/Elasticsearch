<?php

namespace App\Controller\QueryDSL\CompoundQueries;

use App\Service\CreateClientElasticSearch;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FunctionScoreQuerySearchController extends AbstractController
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
     * @Route("/function/score/query/search", name="function_score_query_search")
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
                    'dis_max' => [
                        'queries' => [
                            [
                                'term' => [
                                    '_doc.data.aboutMe' => 'ipsam'
                                ]
                            ]
                        ],
                        "tie_breaker" => 0.9
                    ]
                ]
            ]
        ];
        $response = $client->search($params);

        dd($response);

        return $this->render('function_score_query_search/index.html.twig', [
            'controller_name' => 'FunctionScoreQuerySearchController',
        ]);
    }
}
