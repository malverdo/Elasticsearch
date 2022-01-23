<?php

namespace App\Controller;

use App\Service\CreateClientElasticSearch;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ElasticsearchGetController extends AbstractController
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
     * @Route("/elasticsearch/get/{id}", methods={"GET","HEAD"}, name="elasticsearch_get")
     */
    public function index(int $id): Response
    {
        $client = $this->clientElasticSearch->getClient();
        $id -= 1;
        $from = 10 * $id;
        $params = [
            'index' => 'my_index',
            'from' => $from,
            'size' => 10,
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
        return $this->render('elasticsearch_get/index.html.twig', [
            'controller_name' => 'ElasticsearchGetController',
        ]);
    }
}
