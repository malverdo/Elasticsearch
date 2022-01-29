<?php

namespace App\Controller\SearchYourData;

use App\Service\CreateClientElasticSearch;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PaginateSearchController extends AbstractController
{

    private $startNumber;
    private $middleNumber;
    private $endNumber;
    private $endTotalNumber;
    private $startTotalNumber;

    /**
     * @var CreateClientElasticSearch
     */
    private $clientElasticSearch;

    public function __construct(CreateClientElasticSearch $clientElasticSearch)
    {
        $this->clientElasticSearch = $clientElasticSearch->getClient();
    }

    /**
     * @Route("/paginate/search/{id}", name="paginate_search")
     */
    public function index($id = 0): Response
    {

        $params = [
//            'index' => 'card_index',
            'track_total_hits' => true,
            'size' => 10,
            'body'  => [
                'query' => [
                    'match' => [
                        "_doc.ban" => true
                    ]
                ],
                "pit" => [
                    "id" => "z4S1AwIKY2FyZF9pbmRleBZwcUZNTVFyYVRWeTZGdDNkblZ6MDZRARZsRmNrSjdVc1Q1T29RWWloOG9CZDZRAAAAAAAAAAreFklxRG0zeEUzUVV1ZUZoNW5GS3BmakEACmNhcmRfaW5kZXgWcHFGTU1RcmFUVnk2RnQzZG5WejA2UQAWbEZja0o3VXNUNU9vUVlpaDhvQmQ2UQAAAAAAAAAK3RZJcURtM3hFM1FVdWVGaDVuRktwZmpBAAEWcHFGTU1RcmFUVnk2RnQzZG5WejA2UQAA",
                    'keep_alive' => '1m'
                ],
                'sort' => [
                    [
                        "_score"=> "desc"
                    ],
                    [
                        "_shard_doc"=> "asc"
                    ],
                    [
                        '_doc.id' => [
                            'order' => 'asc'
                        ]
                    ]
                ]
            ]
        ];
        $response = $this->clientElasticSearch->search($params);
        $total = (int) round($response['hits']['total']['value'] / 10);
//        dd($response);

        return $this->render('paginate_search/index.html.twig', [
            'controller_name' => 'PaginateSearchController',
            'pagination' => [
                'endTotal' => $total,
                'startTotal' => 1,
                'start' => $id - 1,
                'middle' => $id ,
                'end' => $id + 1
            ],
            'id' => $response['hits']['hits'][0]['_source']['_doc']['id']
        ]);
    }

    private function pagination()
    {

    }
}
