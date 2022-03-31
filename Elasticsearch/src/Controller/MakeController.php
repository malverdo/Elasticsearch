<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Product;
use App\Service\CreateClientElasticSearch;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;

class MakeController extends AbstractController
{

    /**
     * @var ProductRepository
     */
    private $productRepository;
    /**
     * @var CategoryRepository
     */
    private $categoryRepository;

    public function __construct(ProductRepository $productRepository, CategoryRepository $categoryRepository)
        {
            $this->productRepository= $productRepository;
            $this->categoryRepository = $categoryRepository;
        }

    /**
     * @Route("/make", methods={"GET","HEAD"}, name="make")
     */
    public function index(): Response
    {
        $product = $this->productRepository->findByExampleField('malverdoProduct2');

//        $product = Product::create('malverdoProduct2');
//        $category = Category::create('maleverdoCategory2фas', $product[0]);
//        $this->productRepository->save($product);
//        $this->categoryRepository->save($category);

        $product = $this->productRepository->findAll();
        $b = $product[0]->getCategories()->last();



        $category = $this->categoryRepository->findAll();



        dd($product , $category, $b);
        return $this->render('elasticsearch_get/index.html.twig', [
            'controller_name' => 'ElasticsearchGetController',
        ]);
    }
}
