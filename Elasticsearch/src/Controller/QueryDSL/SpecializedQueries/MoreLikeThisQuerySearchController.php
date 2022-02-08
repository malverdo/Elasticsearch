<?php

namespace App\Controller\QueryDSL\SpecializedQueries;

use App\Service\CreateClientElasticSearch;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MoreLikeThisQuerySearchController extends AbstractController
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
     * @Route("/more/like/this/query/search", name="more_like_this_query_search")
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
                        "like" => 'consequatur',
                        "min_term_freq" => 1,
                        "max_query_terms" => 12
                    ]
                ]
            ]
        ];
        $response = $client->search($params);

        dd($response);


        return $this->render('more_like_this_query_search/index.html.twig', [
            'controller_name' => 'MoreLikeThisQuerySearchController',
        ]);
    }
}
