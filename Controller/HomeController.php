<?php

namespace Controller;

use Model\Entity\Produits;
use Controller\BaseController;
use Form\ProduitsHandleRequest;
use Model\Repository\ProduitsRepository;

class HomeController extends BaseController
{
    private ProduitsRepository $productRepository;
    private ProduitsHandleRequest $form;
    private Produits $product;

    public function __construct()
    {
        $this->productRepository = new ProduitsRepository;
        $this->form = new ProduitsHandleRequest;
        $this->product = new Produits;
    }
    public function list()
    {
        $products = $this->productRepository->findAll($this->product);
        $this->render("home.html.php", [
            "h1" => "Liste des produits",
            "products" => $products
        ]);
    }
}