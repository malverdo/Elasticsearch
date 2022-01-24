<?php

namespace App\Controller;

use App\Service\CreateClientElasticSearch;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SearchElasticMustController extends AbstractController
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
     * @Route("/search/elastic/must", name="search_elastic_must")
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
                                'range' => [
                                    'testField.id' => [
                                        'gte' => '10000'
                                    ]
                                ]
                            ],
                            [
                                'match' => [
                                    'testField.creditCardType' =>  'MasterCard'
                                ]
                            ],
                            [
                                'match' => [
                                    'testField.ban' =>  true
                                ]
                            ]
                        ]
                    ]
                ],

                'sort' => [
                    'testField.id' => [
                        'order' => 'desc'
                    ]
                ]
            ]
        ];
        $response = $this->clientElasticSearch->search($params);
        dd($response);

        return $this->render('search_elastic_must/index.html.twig', [
            'controller_name' => 'SearchElasticMustController',
        ]);
    }
}
