<?php

namespace App\Controller\SearchYourData;

use App\Service\CreateClientElasticSearch;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class InnerHitsSearchController extends AbstractController
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
     * @Route("/inner/hits/search", name="inner_hits_search")
     */
    public function index(): Response
    {

        $params = [
            'index' => 'card_index',
            'track_total_hits' => true,
            'size' => 1,
            'body'  => [
                'query' => [
                    'nested' => [
                        'path' => 'data.lastNameUser',
                        'query' => [
                            'match' => [
                                "_doc.ban" => true
                            ]
                        ],
                        'inner_hits' => []
                    ]
                 ]
            ]
        ];
        $response = $this->clientElasticSearch->search($params);
        dd($response);

        return $this->render('inner_hits_search/index.html.twig', [
            'controller_name' => 'InnerHitsSearchController',
        ]);
    }
}
