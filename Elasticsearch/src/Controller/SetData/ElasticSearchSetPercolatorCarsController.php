<?php

namespace App\Controller\SetData;

use App\Service\CreateClientElasticSearch;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ElasticSearchSetPercolatorCarsController extends AbstractController
{

    /**
     * @var CreateClientElasticSearch
     */
    private $clientElasticSearch;


    /**
     * @param CreateClientElasticSearch $clientElasticSearch
     */
    public function __construct(
        CreateClientElasticSearch $clientElasticSearch
    ) {
        $this->clientElasticSearch = $clientElasticSearch;
    }

    /**
     * @Route("/elastic/search/set/percolator/cars", name="elastic_search_set_percolator_cars")
     */
    public function index(): Response
    {

        $client = $this->clientElasticSearch->getClient();



            $params = [
                'index' => 'index_percolator_cars',
                'id' => 'tesla_model_4_alert',
                'body'  => [
                    'query' => [
                        "query_string" => [
                            'query' => "brand:Tesla AND model:5 AND price:<=50000"
                        ]
                    ],
                    "email" => "malverdo@mail.ru"
                ]
            ];

            $response = $client->index($params);

        return $this->render('elastic_search_set_percolator_cars/index.html.twig', [
            'controller_name' => 'ElasticSearchSetPercolatorCarsController',
        ]);
    }
}
