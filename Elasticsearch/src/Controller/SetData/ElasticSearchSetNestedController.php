<?php

namespace App\Controller\SetData;

use App\Service\CreateClientElasticSearch;
use Faker\Factory;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ElasticSearchSetNestedController extends AbstractController
{

    /**
     * @var CreateClientElasticSearch
     */
    private $clientElasticSearch;

    /**
     * @var Factory
     */
    private $faker;

    /**
     * @param Factory $faker
     * @param CreateClientElasticSearch $clientElasticSearch
     */
    public function __construct(
        Factory $faker,
        CreateClientElasticSearch $clientElasticSearch
    ) {
        $this->clientElasticSearch = $clientElasticSearch;
        $this->faker = $faker::create();
    }


    /**
     * @Route("/elastic/search/set/nested", name="elastic_search_set_nested")
     */
    public function index(): Response
    {


        $client = $this->clientElasticSearch->getClient();

        for ($i = 1; $i <= 300; $i++) {

            $array = [];
            for ($i = 1; $i <= 5; $i++) {
                $arrayData =  [
                    'value' => rand(0,3),
                    'voter' => $this->faker->lastName,
                    'date' => $this->faker->dateTime,
                    'text' => $this->faker->text(55),
                    ];
                $array[] = $arrayData;
            }

            $params = [
                'index' => 'index_nested',
                'body'  => [
                    '_docNested' => [
                            'id' => mt_rand(),
                            'author' => 'Hoeger',
                            'text' => $this->faker->text,
                            'votes' => [
                                $array
                            ],
                            'date' => $this->faker->dateTime,

                    ]
                ]
            ];

            $response = $client->index($params);
        }



        return $this->render('elastic_search_set_nested/index.html.twig', [
            'controller_name' => 'ElasticSearchSetNestedController',
        ]);
    }
}
