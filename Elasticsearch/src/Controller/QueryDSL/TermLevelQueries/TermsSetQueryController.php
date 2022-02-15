<?php

namespace App\Controller\QueryDSL\TermLevelQueries;

use App\Service\CreateClientElasticSearch;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TermsSetQueryController extends AbstractController
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
     * @Route("/terms/set/query", name="terms_set_query")
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
                    'terms_set' => [
                        '_doc.creditCardType' => [
                           "terms" => ['Visa', 'MasterCard'],
                            "minimum_should_match_script" => [
                                "source" => "Math.min(params.num_terms, 5)"
                            ],
                        ]
                    ]
                ]
            ]
        ];
        $response = $client->search($params);

        dd($response);

        return $this->render('terms_set_query/index.html.twig', [
            'controller_name' => 'TermsSetQueryController',
        ]);
    }
}
