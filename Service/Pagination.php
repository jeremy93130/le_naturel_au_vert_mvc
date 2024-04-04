<?php

namespace Service;

use Model\Entity\Produits;
use Model\Repository\ProduitsRepository;

class Pagination
{
    public static $produitsParPage = 6;
    public static function paginate(ProduitsRepository $produitsRepository, $categorie)
    {
        $pageCourante = isset($_GET['page']) ? $_GET['page'] : 1;
        $offset = ($pageCourante - 1) * self::$produitsParPage;

        // Récupérer tous les produits pour la catégorie spécifiée
        $categories = $produitsRepository->findByAttributes('produits', ['categorie' => $categorie]);

        if (is_array($categories)) {
            $totalProduits = count($categories);
            // Extraire les produits de la page actuelle en utilisant array_slice
            $produits = array_slice($categories, $offset, self::$produitsParPage);
        } else {
            // S'il n'y a qu'un seul produit, le total des produits est 1
            $totalProduits = 1;
            $produits = [$categories]; // Mettre le produit unique dans un tableau
        }

        // Retourner les produits de la page courante ainsi que le nombre total de produits
        return [
            'produits' => $produits,
            'totalProduits' => $totalProduits,
            'pageCourante'=> $pageCourante
        ];
    }
}