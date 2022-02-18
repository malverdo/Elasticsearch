<?php

namespace App\Controller\SetData;

use App\Service\CreateClientElasticSearch;
use Faker\Factory;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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
        Factory $faker,
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

        for ($i = 1; $i <= 1; $i++) {


        $params = [
            'index' => 'card_index',
            'body'  => [
                        '_doc' => [
                            'type'=>'pre_wally',
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
                            'number' => [
                                'value' => [
                                    mt_rand(0,10),
                                    mt_rand(0,10),
                                    mt_rand(0,10),
                                    mt_rand(0,10)
                                ],
                                'ip' => [
                                    mt_rand(0,10),
                                    mt_rand(0,10),
                                    mt_rand(0,10),
                                    mt_rand(0,10)
                                ],
                            ],
                            'price' => [
                                mt_rand(0,1000),
                                mt_rand(0,1000),
                                mt_rand(0,1000)
                            ],
                            'product' => 'chocolate',
                            'offer' => [
                                'color' => $this->faker->colorName,
                                'price' => [
                                    mt_rand(0,1000),
                                    mt_rand(0,1000),
                                    mt_rand(0,1000)
                                ]
                            ],
                            'creditCardNumber' => $this->faker->creditCardNumber,
                            'dateTimeThisMonth' => ['date' => time()],

                            'dateTimeRegistrationCard' => $this->faker->dateTime('now'),
                            'creditCardType' => $this->faker->creditCardType,
                            'data' => [
                                'lastNameUser' => $this->faker->lastName,
                                'firstNameUser' => $this->faker->firstName,
                                'aboutMe' => $this->faker->text(200) . ' consequatur' . ' consequatur' . ' onsequatur'
                            ],
                            ]
                        ]
        ];

        $response = $client->index($params);
        }
        return $this->render('elasticsearch_set/index.html.twig', [
            'controller_name' => 'ElasticsearchSetController',
        ]);
    }
}
