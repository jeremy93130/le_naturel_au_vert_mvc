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
}