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

        $client = $this->clientElasticSearch;
        $params = [
            'index' => 'card_index',
            'body' => [
                'query' => [
                    'bool' => [
                        "filter" => [
                            'script' => [
                                'script' => "
                                    double amount = doc['_doc.roleId'].value;
                                    if (doc['_doc.product'].value == 'chocolate') {
                                      amount -= 2;
                                    }
                                    return amount > 5;
                                  "
                            ]
                        ]
                    ]
                ]
            ]
        ];

        $response = $client->search($params);
        dd($response);

        return $this->render('script_query/index.html.twig', [
            'controller_name' => 'ScriptQueryController',
        ]);
    }
}
