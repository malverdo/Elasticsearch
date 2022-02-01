<?php

namespace App\Controller\SearchYourData;

use App\Service\CreateClientElasticSearch;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TemplateSearchController extends AbstractController
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
     * @Route("/template/search", name="template_search")
     */
    public function index(): Response
    {

        $params = [
            'index' => 'index_nested',
            'body' => [
                [

                ],
                [
                    'id' => 'script_test',
                    'params' => [
                        "query_string" => "Hoeger",
                        "from" => 0,
                        "size" => 10
                    ]
                ],
                [

                ],
                [
                    'id' => 'script_test',
                    'params' => [
                        "query_string" => "Hoeger",
                        "from" => 0,
                        "size" => 10
                    ]
                ]
            ]
        ];
        $response = $this->clientElasticSearch->msearchTemplate($params);
//        $response = $this->clientElasticSearch->searchTemplate($params);
        dd($response);


        return $this->render('template_search/index.html.twig', [
            'controller_name' => 'TemplateSearchController',
        ]);
    }
}
