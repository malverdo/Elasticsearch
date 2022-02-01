<?php

namespace App\Controller\CreateIndex;

use App\Service\CreateClientElasticSearch;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ElasticSearchCreateTemplateController extends AbstractController
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
     * @Route("/elastic/search/create/template", name="elastic_search_create_template")
     */
    public function index(): Response
    {
        $client = $this->clientElasticSearch->getClient();
        $params = [
            'id' => 'script_test',
            'body' => [
                'script'  => [
                    'lang' => 'mustache',
                    'source' => [
                        'query' => [
                            'nested' => [
                                'path' => '_docNested',
                                'query' => [
                                    'match' => [
                                        "_docNested.author" => '{{query_string}}'
                                    ]
                                ]
                            ]
                        ],
                        'form' => "{{ from }}",
                        'size' => "{{ size }}"
                    ],
                    'params' => [
                        "query_string" => "My query string",
                        "from" => 0,
                        "size" =>5,
                    ]
                ]
            ]
        ];


        $response = $client->putScript($params);

        return $this->render('elastic_search_create_template/index.html.twig', [
            'controller_name' => 'ElasticSearchCreateTemplateController',
        ]);
    }
}