<?php

namespace Controller;

use Service\Pagination;
use Service\CartManager;
use Controller\BaseController;
use Model\Repository\AvisRepository;
use Service\BackgroundManager;
use Model\Repository\ImagesRepository;
use Model\Repository\ProduitsRepository;
use Service\AvisManager;
use Service\Session;

class HomeController extends BaseController
{
    private ProduitsRepository $productRepository;
    private ImagesRepository $imagesRepository;
    private AvisRepository $avisRepository;

    public function __construct()
    {
        $this->productRepository = new ProduitsRepository;
        $this->imagesRepository = new ImagesRepository;
        $this->avisRepository = new AvisRepository;
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

        // CheminDossier récupère le chemin de chooseProductFolder en fonction de la catégorie du produit pour pouvoir récupérer facilement le bon dossier image
        $cheminDossier = BackgroundManager::chooseProductFolder($categorie);
        $css = BackgroundManager::getBackGround($categorie);
        $produitsParPage = Pagination::$produitsParPage;
        $cssPanier = [];

        foreach ($produits as $product) {
            if (CartManager::isInCart($product->getId())) {
                $cssPanier[$product->getId()] = 'selected_cart'; // On ajoute la classe au tableau $cssPanier si le produit est dans le panier
            } else {
                $cssPanier[$product->getId()] = ''; // sinon on laisse la class à vide
            }
            $noteAvis = $this->avisRepository->getAvisByProduit($product->getId());
            $notesAvisProduits = $this->avisRepository->getAvisFromProduct($product->getId());

            $_SESSION['nbNotes' . $product->getId()] = count($notesAvisProduits);

            if ($noteAvis !== null) {
                $moyenne = AvisManager::getMoyenne($product->getId());
                if ($moyenne !== null) {
                    $noteMoyenne = AvisManager::stars($moyenne);
                    $product->setMoyenne($moyenne);
                    $_SESSION['etoile' . $product->getId()] = $noteMoyenne;
                } else {
                    $product->setMoyenne(null);
                }
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
            'cssRed' => $cssPanier,
        ]);
    }

    public function details($id)
    {
        $detailsProduit = $this->productRepository->findById('produits', $id);
        $cheminDossier = BackgroundManager::chooseProductFolder($detailsProduit->getCategorie());
        $css = BackgroundManager::getBackGround($detailsProduit->getCategorie());

        $item = $this->imagesRepository->carousselImages($id);

        // d_die($item);

        $avis = $this->avisRepository->getAvisByProduit($id);

        // On gère l'utilisation des étoiles, on récupère la note de l'utilisateur puis on la transforme en nombre d'étoiles correspondantes

        $etoile = AvisManager::getEtoiles($avis);

        $avis = AvisManager::formatDateAvis($avis);


        // on vérifie que l'utilisateur a bien acheté le produit s'il veut laisser son avis
        if ($this->getUserId()) {
            $allowAvis = AvisManager::checkUserAchat($this->getUser()->getId(), $detailsProduit->getId());
        } else {
            $allowAvis = "";
        }
        $this->render('details/details.html.php', [
            'detail' => $detailsProduit,
            'cheminDossier' => $cheminDossier,
            'item' => $item,
            'css' => $css,
            'etoile' => $etoile,
            'avis' => $avis,
            'allowAvis' => $allowAvis
        ]);
    }
}
