<?php

namespace App\Controller\QueryDSL\TermLevelQueries;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WallCardQueryController extends AbstractController
{
    /**
     * @Route("//wall/card/query", name="_wall_card_query")
     */
    public function index(): Response
    {
        return $this->render('Цфwall_card_query/index.html.twig', [
            'controller_name' => 'ЦфWallCardQueryController',
        ]);
    }
}
