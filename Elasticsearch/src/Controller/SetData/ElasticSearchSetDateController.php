<?php

namespace App\Controller\SetData;

use App\Service\CreateClientElasticSearch;
use Faker\Factory;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ElasticSearchSetDateController extends AbstractController
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
     * @Route("/elastic/search/set/date", name="elastic_search_set_date")
     */
    public function index(): Response
    {

        $client = $this->clientElasticSearch->getClient();


            $params = [
                'index' => 'date',
                'body'  => [
                    'epoch_millis' => time(),
                    'epoch_second' => time(),
                    'date_now' => time(),
                    'date_optional_time' => "2022-02-11 04:51:48.000000",
                    'dateTimeRegistrationCard' => $this->faker->dateTime()
                ]
            ];

            $response = $client->index($params);



        return $this->render('elastic_search_set_date/index.html.twig', [
            'controller_name' => 'ElasticSearchSetDateController',
        ]);
    }
}
