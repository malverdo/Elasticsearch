<?php

namespace App\Controller\QueryDSL\TermLevelQueries;

use App\Service\CreateClientElasticSearch;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TermsSetQueryController extends AbstractController
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
     * @Route("/terms/set/query", name="terms_set_query")
     */
    public function index(): Response
    {
        return $this->render('terms_set_query/index.html.twig', [
            'controller_name' => 'TermsSetQueryController',
        ]);
    }
}
