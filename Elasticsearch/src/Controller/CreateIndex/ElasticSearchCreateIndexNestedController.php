<?php

namespace App\Controller\CreateIndex;

use App\Service\CreateClientElasticSearch;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ElasticSearchCreateIndexNestedController extends AbstractController
{


    /**
     * @var CreateClientElasticSearch
     */
    private $clientElasticSearch;


    /**
     * @param CreateClientElasticSearch $clientElasticSearch
     */
    public function __construct(
        CreateClientElasticSearch $clientElasticSearch
    ) {
        $this->clientElasticSearch = $clientElasticSearch;
    }

    /**
     * @Route("/elastic/search/create/index/nested", name="elastic_search_create_index_nested")
     */
    public function index(): Response
    {

        $client = $this->clientElasticSearch->getClient();
        $params = [
            'index' => 'index_nested',
            'body'  => [
                'mappings' => [
                    'properties' => [
                        '_docNested' => [
                            'type' => 'nested'
                        ]
                    ]
                ],
                'settings' => [
                    'number_of_shards' => 2,
                    'number_of_replicas' => 0
                ]

            ]

        ];


        $response = $client->indices()->create($params);

        return $this->render('elastic_search_create_index_nested/index.html.twig', [
            'controller_name' => 'ElasticSearchCreateIndexNestedController',
        ]);
    }
}
