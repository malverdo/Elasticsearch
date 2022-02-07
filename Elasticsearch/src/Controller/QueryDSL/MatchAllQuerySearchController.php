<?php

namespace App\Controller\QueryDSL;

use App\Service\CreateClientElasticSearch;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MatchAllQuerySearchController extends AbstractController
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
     * @Route("/match/all/query/search", name="match_all_query_search")
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
                    "match_all" => [
                        "boost" => 1.0
                    ]
                ]
            ]
        ];
        $response = $client->search($params);

        dd($response);

        return $this->render('match_all_query_search/index.html.twig', [
            'controller_name' => 'MatchAllQuerySearchController',
        ]);
    }
}
