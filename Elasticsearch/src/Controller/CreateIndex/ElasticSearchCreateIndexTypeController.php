<?php

namespace App\Controller\CreateIndex;

use App\Service\CreateClientElasticSearch;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ElasticSearchCreateIndexTypeController extends AbstractController
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
     * @Route("/elastic/search/create/index/type", name="elastic_search_create_index_type")
     */
    public function index(): Response
    {

        $client = $this->clientElasticSearch->getClient();
        $params = [
            'index' => 'card_index',
            'body'  => [
                'mappings' => [
                    'properties' => [
                        '_doc' => [
                            'properties' => [
                                'type'=>['type' => 'text'],
                                'id' => ['type' => 'integer'],
                                'cardId' => ['type' => 'integer'],
                                'ban' => ['type' => 'boolean'],
                                'userId' => ['type' => 'integer'],
                                'roleId' => ['type' => 'integer'],
                                'name' => ['type' => 'text'],
                                'address' => ['type' => 'text'],
                                'city' => ['type' => 'text'],
                                'companyEmail' => ['type' => 'text'],
                                'company' => ['type' => 'keyword'],
                                'creditCardNumber' => ['type' => 'long'],
                                'product' => ['type' => 'keyword'],
                                'price' => ['type' => 'keyword'],
                                    'offer' => [
                                        'type' => 'nested',
                                        'properties' => [
                                            'color' => [
                                                'type' => 'keyword'
                                            ],
                                            'price' => [
                                                'type' => 'keyword'
                                            ],
                                        ]
                                    ],

                                'dateTimeThisMonth' => ['type' => 'object', 'properties' => [
                                    'date' => [
                                        'type' => 'date',
                                    ]
                                ]],
                                'dateTimeRegistrationCard' => ['type' => 'object', 'properties' => [
                                    'date' => [
                                        'type' => 'date',
                                        "format" => "yyyy-MM-dd HH:mm:ss.SSSSSS||strict_date_optional_time_nanos||epoch_millis||basic_date_time||basic_ordinal_date"
                                    ]
                                ]],
                                'creditCardType' => ['type' => 'keyword'],
                                'data' => [
                                    'type' => 'object',
                                    'properties' => [
                                            'lastNameUser' => [
                                                'type' => 'text'
                                            ],
                                            'firstNameUser' => [
                                                'type' => 'text'
                                            ],
                                            'aboutMe' => [
                                                'type' => 'text'
                                            ]
                                        ]
                                    ]
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

        return $this->render('elastic_search_create_index_type/index.html.twig', [
            'controller_name' => 'ElasticSearchCreateIndexTypeController',
        ]);
    }
}
