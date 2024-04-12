<?php

namespace Form;

use Model\Entity\Adresse;
use Model\Repository\AdresseRepository;

class AdresseLivraisonHandleRequest extends BaseHandleRequest
{

    public function handleInsertForm(Adresse $adresses)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirme_adresse_livraison'])) {
            extract($_POST);
            $errors = [];
            // Vérification de la validité du formulaire
            if (empty($nomComplet) || empty($adresse) || empty($codePostal) || empty($ville) || empty($pays) || empty($telephone)) {
                $errors[] = "Ce champ ne peut pas être vide";
            }
            if (strlen($nomComplet) < 4 || strlen($adresse) < 4 || strlen($ville) < 1 || strlen($pays) < 2) {
                $errors[] = "Ce champ doit avoir au moins 4 caractères";
            }

            if (empty($errors)) {
                $adresses->setNomComplet($nomComplet)
                    ->setAdresse($adresse)
                    ->setCodePostal($codePostal)
                    ->setVille($ville)
                    ->setPays($pays)
                    ->setTelephone($telephone)
                    ->setInstruction_livraison($instructions ?? null)
                    ->setType('livraison');

                $_SESSION['adresse_livraison'] = $adresses;
                $_SESSION['adresse_facturation'] = clone $adresses;
                return $this;
            }

            $this->setEerrorsForm($errors);
            return $this;
        }
    }
    public function handleEditForm(Adresse $adresse)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['modif_produit'])) {

            extract($_POST);
            $errors = [];
            // Vérification de la validité du formulaire
            if (empty($nom)) {
                $errors[] = "Le nom ne peut pas être vide";
            }
            if (strlen($nom) < 4) {
                $errors[] = "Le nom doit avoir au moins 4 caractères";
            }

            if (empty($errors)) {
                $adresses->setNomComplet($nomComplet)
                    ->setAdresse($adresse)
                    ->setCodePostal($codePostal)
                    ->setVille($ville)
                    ->setPays($pays)
                    ->setTelephone($telephone)
                    ->setInstruction_livraison($instructions ?? null)
                    ->setType('livraison');

                $_SESSION['adresse_livraison'] = $adresses;
                return $this;
            }

            $this->setEerrorsForm($errors);
            return $this;
        }
    }
}