<?php

namespace App\Controller;

use App\Service\CreateClientElasticSearch;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SearchElasticFilterController extends AbstractController
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
     * @Route("/search/elastic/filter", name="search_elastic_filter")
     */
    public function index(): Response
    {

        $params = [
            'index' => 'my_index',
            'size' => 99,
            'body'  => [
                'query' => [
                    'bool' => [
                        'must' => [
                            [
                                'match' => [
                                    'testField.creditCardType' =>  'MasterCard'
                                ]
                            ]
                        ],
                        "filter"=>[
                            "range" => [
                                "testField.dateTimeRegistrationCard.date" => [
                                    "gte" => "1996-07-11",
                                    "lte" => "2000-08-11"
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ];
        $response = $this->clientElasticSearch->search($params);
        dd($response);

        return $this->render('search_elastic_filter/index.html.twig', [
            'controller_name' => 'SearchElasticFilterController',
        ]);
    }
}
