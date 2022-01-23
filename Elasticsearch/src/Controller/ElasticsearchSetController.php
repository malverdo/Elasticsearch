<?php

namespace App\Controller;

use App\Service\CreateClientElasticSearch;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ElasticsearchSetController extends AbstractController
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
     * @Route("/elasticsearch/set", name="elasticsearch_set")
     */
    public function index(): Response
    {
        $client = $this->clientElasticSearch->getClient();
        $params = [
            'index' => 'my_index',
            'body'  => [
                        'testField' => [
                            'type'=>'abc',
                            'id' => mt_rand(1, 1000),
                            'cardId' => mt_rand(1, 1000),
                            'userId' => mt_rand(1, 1000),
                            'roleId' => mt_rand(1, 1000),
                            'name' => mt_rand(1, 1000),
                            ]
                        ]
        ];

        $response = $client->index($params);
        return $this->render('elasticsearch_set/index.html.twig', [
            'controller_name' => 'ElasticsearchSetController',
        ]);
    }
}
