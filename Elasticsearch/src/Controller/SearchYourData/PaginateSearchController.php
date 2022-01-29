<?php

namespace App\Controller\SearchYourData;

use App\Service\CreateClientElasticSearch;
use App\Service\Pagination;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PaginateSearchController extends AbstractController
{

    /**
     * @var Pagination
     */
    private $pagination;

    /**
     * @var CreateClientElasticSearch
     */
    private $clientElasticSearch;

    public function __construct(
        CreateClientElasticSearch $clientElasticSearch,
        Pagination $pagination
    ) {
        $this->clientElasticSearch = $clientElasticSearch->getClient();
        $this->pagination = $pagination;
    }

    /**
     * @Route("/paginate/search/{numberPage}", name="paginate_search")
     */
    public function index($numberPage = 0): Response
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
                    "id" => "z4S1AwIKY2FyZF9pbmRleBZwcUZNTVFyYVRWeTZGdDNkblZ6MDZRARZsRmNrSjdVc1Q1T29RWWloOG9CZDZRAAAAAAAAAAyIFklxRG0zeEUzUVV1ZUZoNW5GS3BmakEACmNhcmRfaW5kZXgWcHFGTU1RcmFUVnk2RnQzZG5WejA2UQAWbEZja0o3VXNUNU9vUVlpaDhvQmQ2UQAAAAAAAAAMhxZJcURtM3hFM1FVdWVGaDVuRktwZmpBAAEWcHFGTU1RcmFUVnk2RnQzZG5WejA2UQAA",
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

        $this->pagination->pagination($numberPage, $total);

//        dd($response);

        return $this->render('paginate_search/index.html.twig', [
            'controller_name' => 'PaginateSearchController',
            'pagination' => [
                'endTotal' => $this->pagination->getEndTotalNumber(),
                'startTotal' => $this->pagination->getStartTotalNumber(),
                'start' => $this->pagination->getStartNumber(),
                'middle' => $this->pagination->getMiddleNumber(),
                'end' => $this->pagination->getEndNumber()
            ],
            'id' => $response['hits']['hits'][0]['_source']['_doc']['id']
        ]);
    }


}
