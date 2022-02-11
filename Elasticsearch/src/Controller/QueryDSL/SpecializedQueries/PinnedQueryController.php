<?php

namespace App\Controller\QueryDSL\SpecializedQueries;

use App\Service\CreateClientElasticSearch;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PinnedQueryController extends AbstractController
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
     * @Route("/pinned/query", name="pinned_query")
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
                    'pinned' => [
                        "ids" => ["lq2_zX4B4GidfWRd5H_T", "mK2_zX4B4GidfWRd5H_g"],
                        "organic" => [
                            'bool' => [
                                'filter' => [
                                    ['term' => ['_doc.data.aboutMe' => "maxime"]],
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ];
        $response = $client->search($params);

        dd($response);

        return $this->render('pinned_query/index.html.twig', [
            'controller_name' => 'PinnedQueryController',
        ]);
    }
}
