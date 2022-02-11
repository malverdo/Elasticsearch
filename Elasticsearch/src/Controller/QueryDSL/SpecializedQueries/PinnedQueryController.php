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
                    'more_like_this' => [
                        "fields" => ["_doc.data.aboutMe"],
                        "like" => 'consequatur null',
                        "min_term_freq" => 1,
                        "max_query_terms" => 12
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
