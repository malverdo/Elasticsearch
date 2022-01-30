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

        for ($i = 1; $i <= 12234; $i++) {


            $params = [
                'index' => 'index_Nested',
                'body'  => [
                    '_docNested' => [
                        'comments'=> [
                            'id' => mt_rand(),
                            'author' => $this->faker->lastName,
                            'text' => $this->faker->text,
                            'votes' => [
                                'value' => rand(0,3),
                                'voter' => $this->faker->lastName,
                                'date' => $this->faker->dateTime,
                                'text' => $this->faker->text(55),
                            ],
                            'date' => $this->faker->dateTime,
                        ],
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
