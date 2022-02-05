<?php

namespace App\Controller\QueryDSL\CompoundQueries;

use App\Service\CreateClientElasticSearch;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ConstantScoreQuerySearchController extends AbstractController
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
     * @Route("/constant/score/query/search", name="constant_score_query_search")
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
                    'boosting' => [
                        'positive' => [
                            'term' => [
                                '_doc.data.aboutMe' => 'ipsam'
                            ]
                        ],
                        'negative' => [
                            'term' => [
                                '_doc.data.aboutMe' => 'perferendis'
                            ]
                        ],
                        "negative_boost" => 0.5
                    ]
                ]
            ]
        ];
        $response = $client->search($params);

        dd($response);
        return $this->render('constant_score_query_search/index.html.twig', [
            'controller_name' => 'ConstantScoreQuerySearchController',
        ]);
    }
}
