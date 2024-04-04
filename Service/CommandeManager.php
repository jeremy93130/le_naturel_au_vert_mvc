<?php

namespace Service;

use Model\Repository\ProduitsRepository;

/**
 * Summary of ProductController
 */
class CommandeManager
{


    public static function recapp(array $data): void
    {
        $productRepository = new ProduitsRepository;
        $commandeData = $data['commandeData'];
        $totalGeneral = 0;
        $errors = [];

        $prixTTC = 0;


        foreach ($commandeData as &$d) {
            $dataProduit = $productRepository->findById('produits', $d['id']);
            $stockRestant = $dataProduit->getStock();
            if ($d['quantite'] > $dataProduit->getStock()) {
                $errors = ['id' => $d['id'], 'erreur_stock' => 'Il n\'y a pas assez de stock pour ce produit, veuillez en choisir moins, Stock restant : ' . $stockRestant];
                break;
            } else {
                // Calcul du prix TTC
                $prixTTC = ($d['categorie'] == 1) ? 0.1 : 0.055;
                $d['prix'] *= $d['quantite'];
                $prixTTCProduit = $d['prix'] + ($d['prix'] * $prixTTC);
                $d['prixTTC'] = number_format($prixTTCProduit, 2);

                // Ajout du prix TTC au total général
                $totalGeneral += $d['prixTTC'];
            }
        }
        if ($errors) {
            echo json_encode($errors);
        } else {
            $_SESSION['commande'] = $commandeData;
            $_SESSION['totalGeneral'] = number_format($totalGeneral, 2, '.', '');;
            echo json_encode(['redirect' => addLink('commande', 'recapp')]);
        }
    }
}
