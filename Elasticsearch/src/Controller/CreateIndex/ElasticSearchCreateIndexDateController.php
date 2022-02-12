<?php

namespace App\Controller\CreateIndex;

use App\Service\CreateClientElasticSearch;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ElasticSearchCreateIndexDateController extends AbstractController
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
     * @Route("/elastic/search/create/index/date", name="elastic_search_create_index_date")
     */
    public function index(): Response
    {

        $client = $this->clientElasticSearch->getClient();
        $params = [
            'index' => 'date',
            'body'  => [
                'mappings' => [
                    'properties' => [
                        '_doc' => [
                            'properties' => [
                                'epoch_millis' => [
                                    'type' => 'date',
                                    "format" => "epoch_millis"
                                ],
                                'epoch_second' => [
                                    'type' => 'date',
                                    "format" => "epoch_second"
                                ],
                                'date_optional_time' => [
                                    'type' => 'date',
                                    "format" => "yyyy-MM-dd HH:mm:ss.SSSSSS||strict_date_optional_time_nanos||epoch_millis||basic_date_time||basic_ordinal_date"
                                ],
                                'dateTimeRegistrationCard' => ['type' => 'object', 'properties' => [
                                    'date' => [
                                        'type' => 'date',
                                        "format" => "yyyy-MM-dd HH:mm:ss.SSSSSS||strict_date_optional_time_nanos||epoch_millis||basic_date_time||basic_ordinal_date"
                                    ]
                                ]],
                            ]
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

        return $this->render('elastic_search_create_index_date/index.html.twig', [
            'controller_name' => 'ElasticSearchCreateIndexDateController',
        ]);
    }
}
