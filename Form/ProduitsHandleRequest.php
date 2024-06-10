<?php

namespace Form;


use Model\Entity\Produits;
use Service\ImageHandler;
use Model\Repository\ProduitsRepository;

class ProduitsHandleRequest extends BaseHandleRequest
{
    private $productRepository;
    private $imageTraitement;
    private $produits;

    public function __construct()
    {
        $this->productRepository = new ProduitsRepository;
        $this->imageTraitement = new ImageHandler;
        $this->produits = new Produits;
    }

    public function handleInsertForm()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_produit'])) {

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
            if (empty($categorie)) {
                $errors[] = "La categorie ne peut pas être vide";
            }
            $this->imageTraitement->handelPhoto($categorie, $this->produits);
            if (empty($errors)) {
                $this->produits->setNomProduit($nom)
                    ->setDescriptionProduit($description)
                    ->setPrixProduit($prix)
                    ->setStock($stock)
                    ->setCaracteristique($caracteristique)
                    ->setEntretien($entretien)
                    ->setCategorie($categorie)
                    ->setLot($lot);
                $this->productRepository->insertProduct($this->produits);
                return $this;
            }   

            $this->setEerrorsForm($errors);
            return $this;
        }
    }
    public function handleEditForm(Produits $product)
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
