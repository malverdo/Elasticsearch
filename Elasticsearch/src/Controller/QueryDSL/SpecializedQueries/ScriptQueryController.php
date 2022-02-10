<?php

namespace App\Controller\QueryDSL\SpecializedQueries;

use App\Service\CreateClientElasticSearch;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ScriptQueryController extends AbstractController
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
     * @Route("/script/query", name="script_query")
     */
    public function index(): Response
    {

        $client = $this->clientElasticSearch->getClient();
        $params = [
            'index' => 'card_index',
            'body' => [
                'mappings' => [
                    'properties' => [
                        "brand" => ["type" => "keyword"],
                        "model" => ["type" => "keyword"],
                        "price" => ["type" => "long"]
                    ]
                ]
            ]
        ];

        $response = $client->indices()->create($params);

        return $this->render('script_query/index.html.twig', [
            'controller_name' => 'ScriptQueryController',
        ]);
    }
}
