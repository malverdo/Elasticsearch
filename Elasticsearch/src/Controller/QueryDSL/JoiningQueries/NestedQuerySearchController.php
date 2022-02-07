<?php

namespace App\Controller\QueryDSL\JoiningQueries;

use App\Service\CreateClientElasticSearch;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NestedQuerySearchController extends AbstractController
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
     * @Route("/nested/query/search", name="nested_query_search")
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
                    'nested' => [
                        'path' => '_doc.offer',
                        'query' => [
                            'match' => [
                                "_doc.offer.price" => 677
                            ]
                        ]
                    ]
                ]
            ]
        ];
        $response = $client->search($params);

        dd($response);

        return $this->render('nested_query_search/index.html.twig', [
            'controller_name' => 'NestedQuerySearchController',
        ]);
    }
}
