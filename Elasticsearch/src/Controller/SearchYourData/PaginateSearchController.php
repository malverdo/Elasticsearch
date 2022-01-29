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
            'index' => 'card_index',
            'from' => 10  * $numberPage,
            'size' =>  10,
            'body'  => [
                'query' => [
                    'match' => [
                        "_doc.ban" => true
                    ]
                ],
                'sort' => [
                    [
                        '_doc.id' => [
                            'order' => 'desc'
                        ]
                    ]
                ],
            ]
        ];
        $response = $this->clientElasticSearch->search($params);
        $total =  round($response['hits']['total']['value'] / 10) - 1;

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
