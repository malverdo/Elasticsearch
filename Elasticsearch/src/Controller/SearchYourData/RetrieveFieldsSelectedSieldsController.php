<?php

namespace App\Controller\SearchYourData;

use App\Service\CreateClientElasticSearch;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RetrieveFieldsSelectedSieldsController extends AbstractController
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
     * @Route("/retrieve/fields/selected/sields", name="retrieve_fields_selected_sields")
     */
    public function index(): Response
    {

        $params = [
            'index' => 'index_nested',
            'track_total_hits' => true,
            'size' => 10,
            'body'  => [
                'query' => [
                    'nested' => [
                        'path' => '_docNested',
                        'query' => [
                            'match' => [
                                "_docNested.author" => 'Hoeger'
                            ]
                        ]
                    ]
                ],
                'fields' => [
                    "_docNested.author.*",
                    "_docNested.votes.voter.*",
                    "_docNested.votes.date.date.*",
                ],
                "_source" => true
            ]
        ];
        $response = $this->clientElasticSearch->search($params);
        dd($response);

        return $this->render('retrieve_fields_selected_sields/index.html.twig', [
            'controller_name' => 'RetrieveFieldsSelectedSieldsController',
        ]);
    }
}
