<?php

namespace App\Controller;

use App\Service\CreateClientElasticSearch;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ElasticsearchSetController extends AbstractController
{
    /**
     * @var CreateClientElasticSearch
     */
    private $clientElasticSearch;

    public function __construct(CreateClientElasticSearch $clientElasticSearch)
    {
        $this->clientElasticSearch = $clientElasticSearch;
    }

    /**
     * @Route("/elasticsearch/set", name="elasticsearch_set")
     */
    public function index(): Response
    {
        $client = $this->clientElasticSearch->getClient();
        $params = [
            'index' => 'my_index',
            'id'    => 'my_id',
            'body'  => ['testField' => 'abc']
        ];

        $response = $client->index($params);
        return $this->render('elasticsearch_set/index.html.twig', [
            'controller_name' => 'ElasticsearchSetController',
        ]);
    }
}
