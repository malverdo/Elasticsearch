<?php

namespace App\Controller;

use App\Service\CreateClientElasticSearch;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SearchElasticAggsController extends AbstractController
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
     * @Route("/search/elastic/aggs", name="search_elastic_aggs")
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
                        ]
                    ]
                 ],
                "aggs" => [
                    "terms_roleId" => [
                        "max" => [
                            "field" => "testField.roleId"
                        ]
                    ]
                ]
            ]
        ];
        $response = $this->clientElasticSearch->search($params);
        dd($response);

        return $this->render('search_elastic_aggs/index.html.twig', [
            'controller_name' => 'SearchElasticAggsController',
        ]);
    }
}
