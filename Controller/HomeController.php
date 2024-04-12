<?php

namespace Controller;

use Controller\BaseController;
use Model\Repository\ImagesRepository;
use Model\Repository\ProduitsRepository;
use Service\BackgroundManager;
use Service\CartManager;
use Service\Pagination;

class HomeController extends BaseController
{
    private ProduitsRepository $productRepository;
    private ImagesRepository $imagesRepository;

    public function __construct()
    {
        $this->productRepository = new ProduitsRepository;
        $this->imagesRepository = new ImagesRepository;
    }

    public function index()
    {
        // Si la confirmation de paiement a été affichée à l'utilisateur et qu'il recharge la page
        if (isset($_SESSION['confirmation_affichee'])) {
            unset($_SESSION['confirmation_affichee']);
            header("Location: " . addLink('home', 'index'));
            exit;
        }
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
        $cssPanier = array();
        foreach ($produits as $product) {
            if (CartManager::isInCart($product->getId())) {
                $cssPanier[$product->getId()] = 'selected_cart'; // On ajoute la classe au tableau $cssPanier si le produit est dans le panier
            } else {
                $cssPanier[$product->getId()] = ''; // sinon on laisse la class à vide
            }
        }
        $this->render("achats/produits.html.php", [
            "h1" => "Liste des produits",
            "produits" => $produits,
            'categorie' => $categorie,
            'totalProduits' => $totalProduits,
            'produitsParPage' => $produitsParPage,
            'pageCourante' => $pageCourante,
            'cheminDossier' => $cheminDossier,
            'css' => $css,
            'cssRed' => $cssPanier
        ]);
    }

    public function details($id)
    {
        $detailsProduit = $this->productRepository->findById('produits', $id);
        // d_die($detailsProduit);
        $cheminDossier = BackgroundManager::chooseProductFolder($detailsProduit->getCategorie());
        $css = BackgroundManager::getBackGround($detailsProduit->getCategorie());

        $item = $this->imagesRepository->findById('images', $id);

        $this->render('details/details.html.php', [
            'detail' => $detailsProduit,
            'cheminDossier' => $cheminDossier,
            'item' => $item,
            'css' => $css
        ]);
    }
}
