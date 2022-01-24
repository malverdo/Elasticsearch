<?php

namespace App\Controller;

use App\Service\CreateClientElasticSearch;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SearchElasticMatchController extends AbstractController
{
    /**
     * @var CreateClientElasticSearch
     */
    private $clientElasticSearch;

    public function __construct(CreateClientElasticSearch $clientElasticSearch)
    {
        $this->clientElasticSearch = $clientElasticSearch;
    }

    /**
     * @Route("/search/elastic/match", name="search_elastic_match")
     */
    public function index(): Response
    {
        $client = $this->clientElasticSearch->getClient();
        $params = [
            'index' => 'my_index',
            'size' => 99,
            'body'  => [
                'query' => [
                    'match' => [
                        'testField.creditCardType' =>  'MasterCard'
                    ]
                ],
                'sort' => [
                    'testField.id' => [
                        'order' => 'desc'
                    ]
                ]
            ]
        ];
        $response = $client->search($params);

        dd($response);
        return $this->render('search_elastic_match/index.html.twig', [
            'controller_name' => 'SearchElasticMatchController',
        ]);
    }
}
