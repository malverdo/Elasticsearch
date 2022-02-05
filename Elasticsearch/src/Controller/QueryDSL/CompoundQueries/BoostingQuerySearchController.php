<?php

namespace App\Controller\QueryDSL\CompoundQueries;

use App\Service\CreateClientElasticSearch;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BoostingQuerySearchController extends AbstractController
{

    /**
     * @var CreateClientElasticSearch
     */
    private $clientElasticSearch;


    /**
     * @param CreateClientElasticSearch $clientElasticSearch
     */
    public function __construct(
        CreateClientElasticSearch $clientElasticSearch
    ) {
        $this->clientElasticSearch = $clientElasticSearch;
    }

    /**
     * @Route("/boosting/query/search", name="boosting_query_search")
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
                    '2' => 2
                ]
            ]
        ];
        $response = $client->search($params);

        dd($response);


        return $this->render('boosting_query_search/index.html.twig', [
            'controller_name' => 'BoostingQuerySearchController',
        ]);
    }
}
