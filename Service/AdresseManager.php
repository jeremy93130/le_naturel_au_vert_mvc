<?php

namespace Service;

use Model\Entity\User;
use Model\Entity\Adresse;
use Model\Repository\AdresseRepository;

class AdresseManager
{
    public static function AdresseTableauOuObjet($adresse_facturation)
    {
        if (is_array($adresse_facturation)) {
            // Si $adresseFacturation est un tableau
            $adresse_facturation['type'] = "facturation";
            unset($adresse_facturation['instruction_livraison']);
        } elseif ($adresse_facturation instanceof Adresse) {
            // Si $adresseFacturation est un objet de la classe YourAddressClass
            $adresse_facturation->setType("facturation");
            $adresse_facturation->setInstruction_livraison(null);
        }

        return $adresse_facturation;
    }

    public static function isObject(Adresse $adresse)
    {
        if (is_object($adresse)) {
            // Extraire les propriétés de l'objet et les placer dans un tableau
            $adresse = [
                'id' => $adresse->getId(),
                'nom_complet' => $adresse->getNomComplet(),
                'adresse' => $adresse->getAdresse(),
                'code_postal' => $adresse->getCodePostal(),
                'ville' => $adresse->getVille(),
                'pays' => $adresse->getPays(),
                'instruction_livraison' => $adresse->getInstruction_livraison() ?? null,
                'client_id' => $adresse->getClient(),
                'telephone' => $adresse->getTelephone(),
                'type' => $adresse->getType(),
                'commande_id' => $adresse->getCommandeId(),
                // Ajoutez d'autres propriétés au besoin
            ];

            return $adresse;
        }
    }

    public static function checkAdresse(int $user, AdresseRepository $adresseRepository)
    {
        $adresse_livraison = null;
        $adresse_facturation = null;

        $checkAdresseLivraison = $adresseRepository->findLastLivraison($user);
        $checkAdresseFacturation = $adresseRepository->findLastFacturation($user);

        if ($checkAdresseLivraison && $checkAdresseFacturation) {
            $adresse_livraison = $checkAdresseLivraison;
            $adresse_facturation = $checkAdresseFacturation;
        } else if (isset($_SESSION['adresse_livraison'])) {
            $adresse_livraison = $_SESSION['adresse_livraison'];
            $adresse_facturation = $_SESSION['adresse_facturation'];
        }

        return [
            'livraison' => $adresse_livraison,
            'facturation' => $adresse_facturation
        ];
    }
}