<?php

namespace Service;

use Model\Entity\Adresse;

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

    public static function chooseProductFolder($categorie)
    {

    }
}