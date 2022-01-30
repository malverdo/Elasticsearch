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
            'index' => 'card_index',
            'size' => 20,
            'body'  => [
                'query' => [
                    'match' => [
                        '_doc.creditCardType' =>  'MasterCard'
                    ]
                ],
                'collapse' => [
                    'field' =>  '_doc.cardId',
                    'inner_hits' => [
                        [
                            'name' => 'descId',
                            'collapse' => ['field' => '_doc.roleId'],
                            'size' => 20,
                            "sort" => [
                                '_doc.id' => [
                                    "order" => "desc"
                                ]
                            ]
                        ],
                        [
                            'name' => 'ascId',
                            "_source" => false,
                            'size' => 20,
                            "sort" => [
                                '_doc.id' => [
                                    "order" => "asc"
                                ]
                            ]
                        ]
                    ],

                ],
                'sort' => [
                   '_doc.roleId' => [
                       "order" => "desc"
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
