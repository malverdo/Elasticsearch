<?php

namespace App\Controller;

use App\Service\CreateClientElasticSearch;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Faker\Factory;

class ElasticsearchSetController extends AbstractController
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
        $faker,
        CreateClientElasticSearch $clientElasticSearch
    ) {
        $this->clientElasticSearch = $clientElasticSearch;
        $this->faker = $faker::create();
    }

    /**
     * @Route("/elasticsearch/set", name="elasticsearch_set")
     */
    public function index(): Response
    {
        $client = $this->clientElasticSearch->getClient();
        $params = [
            'index' => 'my_index',
            'body'  => [
                        'testField' => [
                            'type'=>'abc',
                            'id' => mt_rand(1, 100000),
                            'cardId' => mt_rand(1, 100000),
                            'ban' => $this->faker->boolean,
                            'userId' => mt_rand(1, 100000),
                            'roleId' => mt_rand(1, 10),
                            'name' => $this->faker->name,
                            'address' => $this->faker->address,
                            'city' => $this->faker->city,
                            'companyEmail' => $this->faker->companyEmail,
                            'company' => $this->faker->company,
                            'creditCardNumber' => $this->faker->creditCardNumber,
                            'dateTimeThisMonth' => $this->faker->dateTimeThisMonth,
                            'dateTimeRegistrationCard' => $this->faker->dateTime,
                            'creditCardType' => $this->faker->creditCardType,
                            ]
                        ]
        ];

        $response = $client->index($params);
        return $this->render('elasticsearch_set/index.html.twig', [
            'controller_name' => 'ElasticsearchSetController',
        ]);
    }
}
