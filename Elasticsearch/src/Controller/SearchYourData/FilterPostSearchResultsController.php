<?php

namespace App\Controller\SearchYourData;

use App\Service\CreateClientElasticSearch;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FilterPostSearchResultsController extends AbstractController
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
     * @Route("/filter/post/search/results", name="filter_post_search_results")
     */
    public function index(): Response
    {

        $params = [
            'index' => 'card_index',
            'track_total_hits' => true,
            'size' => 11,
            'body'  => [
                'query' => [
                    'bool' => [
                        'filter' => [
                            ['term' => ['_doc.ban' => true]],
                        ]
                    ]
                ],
                'aggs' => [
                    'creditCardType' => [
                        'terms' => ['field' => '_doc.creditCardType']
                    ],
                    'visa' => [
                        'filter' => [
                            'term' => ['_doc.creditCardType' => 'Visa'],
                        ],
                        'aggs' => [
                            'roleId' => [
                                'terms' => ['field' => '_doc.roleId']
                            ]
                        ]
                    ]
                ],
                'post_filter' => [
                    'term' => ['_doc.creditCardType' => 'Visa']
                ]
            ]
        ];
        $response = $this->clientElasticSearch->search($params);
        dd($response);

        return $this->render('filter_post_search_results/index.html.twig', [
            'controller_name' => 'FilterPostSearchResultsController',
        ]);
    }
}
