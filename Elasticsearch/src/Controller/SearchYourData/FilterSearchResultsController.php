<?php

namespace App\Controller\SearchYourData;

use App\Service\CreateClientElasticSearch;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FilterSearchResultsController extends AbstractController
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
     * @Route("/filter/search/results", name="filter_search_results")
     */
    public function index(): Response
    {
        $params = [
            'index' => 'card_index',
            'track_total_hits' => true,
            'size' => 0,
            'body'  => [
                'query' => [
                    'match' => [
                        '_doc.creditCardType' =>  'MasterCard'
                    ]
                ],

                'sort' => [
                    '_doc.roleId' => [
                        "order" => "desc"
                    ]
                ],
            ]
        ];
        $response = $this->clientElasticSearch->search($params);
        dd($response);


        return $this->render('filter_search_results/index.html.twig', [
            'controller_name' => 'FilterSearchResultsController',
        ]);
    }
}
