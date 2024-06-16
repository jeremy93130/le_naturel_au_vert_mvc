<?php

namespace Form;


use Model\Entity\Produits;
use Service\ImageHandler;
use Model\Repository\ProduitsRepository;
use Service\FormSecurity;

class ProduitsHandleRequest extends BaseHandleRequest
{
    private $productRepository;
    private $imageTraitement;
    private $produits;
    private $modifElement;

    public function __construct()
    {
        $this->productRepository = new ProduitsRepository;
        $this->imageTraitement = new ImageHandler;
        $this->produits = new Produits;
    }

    public function handleInsertForm()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_produit'])) {
            FormSecurity::htmlSecurity($_POST);
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
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            extract($_POST);
            $errors = [];
            // Vérification de la validité du formulaire
            if (isset($_POST['nom']) && empty($nom)) {
                $errors[] = "Le nom ne peut pas être vide";
            }
            if (isset($_POST['nom']) && strlen($nom) < 4) {
                $errors[] = "Le nom doit avoir au moins 4 caractères";
            }
            if (isset($_POST['nom']) && strlen($nom) > 20) {
                $errors[] = "Le nom ne peut avoir plus de 20 caractères";
            }

            if (isset($_POST['image']) && !(isset($_FILES["image"]) && $_FILES["image"]["error"] == UPLOAD_ERR_OK)) {
                $errors[] = "Veuillez sélectionner une image à télécharger pour continuer.";
            }

            if (empty($errors)) {
                if (isset($_POST['nom'])) {
                    $product->setNomProduit($_POST['nom']);
                    $this->modifElement = 'Le nom';
                }
                if (isset($_POST['description'])) {
                    $product->setDescriptionProduit($_POST['description']);
                    $this->modifElement = 'La description';
                }
                if (isset($_POST['prix'])) {
                    $product->setPrixProduit($_POST['prix']);
                    $this->modifElement = 'Le prix';
                }
                if (isset($_POST['stock'])) {
                    $product->setStock($_POST['stock']);
                    $this->modifElement = 'Le stock';
                }
                if (isset($_POST['caracteristique'])) {
                    $product->setCaracteristique($_POST['caracteristique']);
                    $this->modifElement = 'La caracteristique';
                }
                if (isset($_POST['entretien'])) {
                    $product->setEntretien($_POST['entretien']);
                    $this->modifElement = 'L\'entretien';
                }
                if (isset($_POST['categorie'])) {
                    $product->setCategorie($_POST['categorie']);
                    $this->modifElement = 'La catégorie';
                }
                if (isset($_POST['lot'])) {
                    $product->setLot($_POST['lot']);
                    $this->modifElement = 'Le lot';
                }
                return $this;
            }
            $this->setEerrorsForm($errors);
            return $this;
        }
    }

    public function getModifElement()
    {
        return $this->modifElement;
    }
}
