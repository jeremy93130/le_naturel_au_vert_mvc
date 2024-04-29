<?php

namespace Service;

use Model\Entity\Adresse;
use Model\Entity\Commande;
use Model\Entity\Produits;
use Model\Entity\User;
use Model\Repository\AdresseRepository;
use Model\Repository\CommandeRepository;
use Model\Repository\ProduitsRepository;
use Model\Repository\DetailCommandeRepository;
use Model\Repository\UserAdresseCommandeRepository;
use Model\Repository\UserRepository;


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
                $total = $d['prix'] * $d['quantite'];
                $prixTTCProduit = $total + ($total * $prixTTC);
                $d['prixTTC'] = number_format($d['prix'] + ($d['prix'] * $prixTTC), 2);
                $d['prixTotalTTC'] = number_format($prixTTCProduit, 2);

                // Ajout du prix TTC au total général
                $totalGeneral += $d['prixTotalTTC'];
            }
        }
        if ($errors) {
            echo json_encode($errors);
        } else {
            $_SESSION['commande'] = $commandeData;
            $_SESSION['totalGeneral'] = number_format($totalGeneral, 2, '.', '');
            ;
            echo json_encode(['redirect' => addLink('commande', 'recapp')]);
        }
    }

    public static function history($user)
    {
        $detailsCommandes = new DetailCommandeRepository;
        $details = $detailsCommandes->findByUserAdresseCommande($user);

        $formattedResult = [];

        foreach ($details as $d) {
            $adresseRepository = new AdresseRepository;
            $adresse = $adresseRepository->findByCommande($d->getCommandeId());

            $commandeRepository = new CommandeRepository;
            $commande = $commandeRepository->findById('commande', $d->getCommandeId());

            $produitRepository = new ProduitsRepository;
            $produit = $produitRepository->findById('produits', $d->getProduitId());

            $userRepository = new UserRepository;
            $user = $userRepository->findById('user', $user->getId());

            // Vérifier si la commande existe déjà dans $formattedResult
            if (isset($formattedResult[$commande->getId()])) {
                // Vérifier si le produit a déjà été ajouté à la commande
                $produitExiste = false;
                foreach ($formattedResult[$commande->getId()]['produits'] as $prod) {
                    // d_die($prod);
                    if ($prod['produit']->getId() === $produit->getId()) {
                        $produitExiste = true;
                        break;
                    }
                }
                // Si le produit n'existe pas, l'ajouter à la liste des produits de cette commande
                if (!$produitExiste) {
                    $formattedResult[$commande->getId()]['produits'][] = ['produit' => $produit, 'quantite' => $d->getQuantite()];
                }
            } else {
                // Si la commande n'existe pas, créer une nouvelle entrée pour cette commande dans $formattedResult
                $formattedResult[$commande->getId()] = [
                    'user' => $user,
                    'adresse' => $adresse,
                    'commande' => $commande,
                    'produits' => [
                        [
                            'produit' => $produit,
                            'quantite' => $d->getQuantite(),
                        ]
                    ], // Créer un tableau contenant le premier produit de la commande
                ];
            }
        }
        return $formattedResult;
    }
}
