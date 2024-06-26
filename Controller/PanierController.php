<?php

/**
 * Summary of namespace Controller
 */

namespace Controller;

use Model\Repository\ProduitsRepository;
use Service\CartManager;
use Service\BackgroundManager;

/**
 * Summary of ProductController
 */
class PanierController extends BaseController
{
    private ProduitsRepository $produitsRepository;
    public function __construct()
    {
        $this->produitsRepository = new ProduitsRepository;
    }


    public function index()
    {
        if (isset($_POST['tailleEcran'])) {
            CartManager::checktaille($_POST['tailleEcran']);
        }
    }

    public function addToCart(): void
    {
        // Lit le corps de la requête et stock le contenu dans la variable jsonContent
        $jsonContent = file_get_contents('php://input');

        $data = json_decode($jsonContent, true);

        if ($data === null) {
            echo json_encode(['error' => 'erreur lors du décodage Json']);
            return;
        }

        $produitId = $data['id'];
        $cm = new CartManager();
        $cm->addCart($produitId);
    }


    /**
     * Summary of show
     * @return void
     */
    public function show()
    {
        // unset($_SESSION['cart']);
        // unset($_SESSION['nombre']);
        $totalGeneral = 0;
        $cssRed = '';
        $produits = isset($_SESSION['cart']) ? $_SESSION['cart'] : null;
        if (isset($produits)) {
            foreach ($produits as &$p) {
                $totalGeneral += $p['prix'] * $p['nbArticles'];
                $cheminDossier = BackgroundManager::chooseProductFolder($p['categorie']);
                // Ajouter le chemin du dossier à chaque produit
                $p['cheminDossier'] = $cheminDossier;
            }
            $_SESSION['totalGeneral'] = $totalGeneral;
        }

        if (isset($_SESSION['grand_panier'])) {
            $this->render("panier/panier.html.php", [
                "h1" => "Fiche cart",
                'produits' => $produits,
                'cssRed' => $cssRed
            ]);
        } else if (isset($_SESSION['petit_panier'])) {
            $this->render("panier/panier_mobile.html.php", [
                "h1" => "Fiche cart",
                'produits' => $produits,
                'cssRed' => $cssRed
            ]);
        }
    }
    /**
     * Summary of edit
     * @param mixed $id
     * @return void
     */
    public function edit($id)
    {
    }

    public function delete($id)
    {
        $jsonContent = file_get_contents('php://input');
        if (!empty($jsonContent)) {
            // Décoder le contenu JSON en tableau associatif
            $jsonData = json_decode($jsonContent, true);

            // Vérifier si l'ID existe dans les données JSON
            if (isset($jsonData['id'])) {
                // Récupérer l'ID à partir des données JSON
                $id = $jsonData['id'];
            }
        }

        $cm = new CartManager;
        $cm->deleteFromCart($id);
    }

    public function deleteAll()
    {
        $cm = new CartManager;
        $cm->deleteAll();
    }
}
