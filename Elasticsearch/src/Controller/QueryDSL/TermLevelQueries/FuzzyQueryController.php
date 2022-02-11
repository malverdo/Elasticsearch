<?php

namespace App\Controller\QueryDSL\TermLevelQueries;

use App\Service\CreateClientElasticSearch;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FuzzyQueryController extends AbstractController
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
     * @Route("/fuzzy/query", name="_fuzzy_query")
     */
    public function index(): Response
    {

        $client = $this->clientElasticSearch;
        $params = [
            'index' => 'card_index',
            'track_total_hits' => true,
            'size' => 10,
            'body' => [
                'query' => [
                    'fuzzy' => [
                        '_doc.company' => [
                                'value' => 'Nicolas cn',
                                "fuzziness"=> "AUTO",
                                "max_expansions"=> 50,
                                "prefix_length"=> 0,
                                "transpositions"=> true,
                                "rewrite"=> "constant_score"
                            ]
                        ]
                    ]
                ]

        ];
        $response = $client->search($params);

        dd($response);

        return $this->render('Аfuzzy_query/index.html.twig', [
            'controller_name' => 'АFuzzyQueryController',
        ]);
    }
}
