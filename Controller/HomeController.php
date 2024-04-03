<?php

namespace Controller;

use Model\Entity\Produits;
use Controller\BaseController;
use Form\ProduitsHandleRequest;
use Model\Repository\ProduitsRepository;
use Service\BackgroundManager;
use Service\Pagination;

class HomeController extends BaseController
{
    private ProduitsRepository $productRepository;
    private ProduitsHandleRequest $form;
    private Produits $produits;

    public function __construct()
    {
        $this->productRepository = new ProduitsRepository;
        $this->form = new ProduitsHandleRequest;
        $this->produits = new Produits;
    }

    public function index()
    {
        $this->render('home.html.php', ["h1" => "Accueil"]);
    }
    public function list($categorie)
    {
        $paginationData = Pagination::paginate($this->productRepository, $categorie);
        $produits = $paginationData['produits'];
        $totalProduits = $paginationData['totalProduits'];
        $pageCourante = $paginationData['pageCourante'];

        $cheminDossier = BackgroundManager::chooseProductFolder($categorie);
        $css = BackgroundManager::getBackGround($categorie);
        $produitsParPage = Pagination::$produitsParPage;

        $this->render("achats/produits.html.php", [
            "h1" => "Liste des produits",
            "produits" => $produits,
            'categorie' => $categorie,
            'totalProduits' => $totalProduits,
            'produitsParPage' => $produitsParPage,
            'pageCourante' => $pageCourante,
            'cheminDossier' => $cheminDossier,
            'css' => $css
        ]);
    }

    public function details($id)
    {



        $this->render('details/details.html.php', [
        ]);
    }
}