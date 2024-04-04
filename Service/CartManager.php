<?php

namespace Service;

use Model\Entity\Produits;
use Model\Repository\ProduitsRepository;

/**
 * Summary of ProductController
 */
class CartManager
{
    private ProduitsRepository $productRepository;

    public function __construct()
    {
        $this->productRepository = new ProduitsRepository;
    }

    public function addCart($id): void
    {
        $quantity = 1;
        $pr = $this->productRepository;
        $product = $pr->findById('produits', $id);

        if (!$product) {
            echo json_encode(['message' => 'Plante introuvable']);
        }

        if (!isset($_SESSION["cart"])) {
            $_SESSION["cart"] = [];
        } else {
            $panier = $_SESSION['cart'];
            if (array_key_exists($id, $panier)) {
                echo json_encode(['doublon' => "Ce produit est déjà dans votre panier"]);
                return;
            }
        }

        $panier[$id] = [
            'id' => $product->getId(),
            'nom' => $product->getNomProduit(),
            'prix' => $product->getPrixProduit(),
            'image' => $product->getImage(),
            'nbArticles' => $quantity,
            'categorie' => $product->getCategorie(),
            'lot' => $product->getLot()
        ];

        $_SESSION["cart"] = $panier;  // je remets $panier dans la session, à l'indice 'cart'

        $nb = 0;
        foreach ($panier as $value) {
            $nb += $value["nbArticles"];
        }
        $_SESSION["nombre"] = $nb;

        echo json_encode(['message' => 'Votre produit a bien été ajouté au panier', 'totalQuantite' => $nb]);
    }

    public static function isInCart($productId)
    {
        $sessionPanier = $_SESSION['cart'] ?? [];
        foreach ($sessionPanier as $session) {
            if ($session['id'] == $productId) {
                return true;
            }
        }
        return false;
    }


    public static function deleteFromCart($id)
    {
        if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
            foreach ($_SESSION['cart'] as $key => $cart) {
                if ($cart['id'] == $id) {
                    unset($_SESSION['cart'][$key]);
                    $_SESSION['nombre']--;
                    if ($_SESSION['nombre'] == 0) {
                        $_SESSION['nombre'] = "";
                    }
                    break;
                }
            }
            echo json_encode(['success' => "Article bien supprimé"]);
        } else {
            echo json_encode(['erreur' => 'une erreur s\'est produite']);
        }
    }

    public static function deleteAll()
    {
        unset($_SESSION['cart']);
        unset($_SESSION['nombre']);
        echo json_encode(['success' => 'Super']);
    }
}