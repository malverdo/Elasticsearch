<?php

namespace App\Controller\SearchYourData;

use App\Service\CreateClientElasticSearch;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CollapseSearchResultsController extends AbstractController
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
     * @Route("/collapse/search/results", name="collapse_search_results")
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

        return $this->render('collapse_search_results/index.html.twig', [
            'controller_name' => 'CollapseSearchResultsController',
        ]);
    }
}
