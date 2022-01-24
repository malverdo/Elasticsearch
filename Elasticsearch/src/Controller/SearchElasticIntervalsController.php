<?php

namespace App\Controller;

use App\Service\CreateClientElasticSearch;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SearchElasticIntervalsController extends AbstractController
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
     * @Route("/search/elastic/intervals", name="search_elastic_intervals")
     */
    public function index(): Response
    {
        $params = [
            'index' => 'my_index',
            'size' => 99,
            'body'  => [
                'query' => [
                    'match' => [
                        'testField.creditCardType' =>  [
                            'query' => 'MasterCard',
                            "fuzziness" => "AUTO"
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

        return $this->render('search_elastic_intervals/index.html.twig', [
            'controller_name' => 'SearchElasticIntervalsController',
        ]);
    }
}
