<?php

namespace App\Controller\QueryDSL\SpecializedQueries;

use App\Service\CreateClientElasticSearch;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WrapperQueryController extends AbstractController
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
     * @Route("/wrapper/query", name="wrapper_query")
     */
    public function index(): Response
    {

        $client = $this->clientElasticSearch;
        $params = [
            'index' => 'card_index',
            'track_total_hits' => true,
            'size' => 51,
            'body' => [
                'query' => [
                    'wrapper' => [
                        "query" => "eyJ0ZXJtIiA6IHsgIl9kb2MucHJpY2UiIDogNTQxIH19"
                    ]
                ]
            ]
        ];
        $response = $client->search($params);

        dd($response);

        return $this->render('wrapper_query/index.html.twig', [
            'controller_name' => 'WrapperQueryController',
        ]);
    }
}
