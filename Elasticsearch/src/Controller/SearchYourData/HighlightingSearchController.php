<?php

namespace App\Controller\SearchYourData;

use App\Service\CreateClientElasticSearch;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HighlightingSearchController extends AbstractController
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
     * @Route("/highlighting/search", name="highlighting_search")
     */
    public function index(): Response
    {

        $params = [
            'index' => 'card_index',
            'track_total_hits' => true,
            'size' => 1,
            'body'  => [
                'query' => [
                    'match' => [
                        "_doc.data.aboutMe" => 'tempora'
                    ]
                ],
                'highlight' => [
                    'fields' => [
                        '_doc.data.aboutMe' => [
                            "type" => 'unified',
                            "pre_tags" => ["<b>"],
                             "post_tags" => ["</b>"],
                            'boundary_scanner' => 'word',
                        ]
                    ]
                ]
            ]
        ];
        $response = $this->clientElasticSearch->search($params);
        dd($response);

        return $this->render('highlighting_search/index.html.twig', [
            'controller_name' => 'HighlightingSearchController',
        ]);
    }
}
