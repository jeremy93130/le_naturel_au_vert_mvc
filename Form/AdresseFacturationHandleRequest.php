<?php

namespace Form;

use Model\Entity\Adresse;
use Model\Repository\AdresseRepository;

class AdresseFacturationHandleRequest extends BaseHandleRequest
{
    private AdresseRepository $adresseRepository;
    private $imageTraitement;

    public function __construct()
    {
        $this->adresseRepository = new AdresseRepository;
    }

    public function handleInsertForm(Adresse $adresses)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirme_adresse_facturation'])) {
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
                $adresses->setNomComplet($nom_complet)
                    ->setAdresse($adresse)
                    ->setCodePostal($code_postal)
                    ->setVille($ville)
                    ->setPays($pays)
                    ->setTelephone($telephone)
                    ->setInstruction_livraison($instructions ?? null)
                    ->setType('facturation');

                $_SESSION['adresse_facturation'] = $adresses;
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
            if (strlen($nom) > 20) {
                $errors[] = "Le nom ne peut avoir plus de 20 caractères";
            }

            if (!(isset($_FILES["image"]) && $_FILES["image"]["error"] == UPLOAD_ERR_OK)) {
                $errors[] = "Veuillez sélectionner une image à télécharger pour continuer.";
            }

            if (!is_numeric($prix)) {
                $errors[] = "Le prix doit avoir une valeur numérique";
            }
            if (empty($prix)) {
                $errors[] = "Le prix ne peut pas être vide";
            }
            if (!is_numeric($stock)) {
                $errors[] = "Le stock doit avoir une valeur numérique";
            }
            if (empty($stock)) {
                $errors[] = "Le stock ne peut pas être vide";
            }

            if (empty($errors)) {
                $product->setNomProduit($title);
                $product->setDescriptionProduit($description ?? null);
                $product->setPrixProduit($prix_produit);
                $product->setStock($stock);
                $product->setCaracteristique($carac);
                $product->setEntretien($entretien);
                $product->setCategorie($categorie);
                $product->setLot($lot);
                return $this;
            }

            $this->setEerrorsForm($errors);
            return $this;
        }
    }
}