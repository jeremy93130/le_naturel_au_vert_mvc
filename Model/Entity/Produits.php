<?php
namespace Model\Entity;

use Model\Entity\Category;

class Produits extends BaseEntity
{
    private $nom_produit;
    private $description_produit;
    private $prix_produit;
    private $price;
    private $stock;
    private $image;
    private $caracteristiques;
    private $entretien;
    private $categorie;
    private $lot;
    private $image_id;
    public function getNomProduit()
    {
        return $this->nom_produit;
    }

    public function setNomProduit($nom_produit)
    {
        $this->nom_produit = $nom_produit;

        return $this;
    }

    public function getDescriptionProduit()
    {
        return $this->description_produit;
    }

    public function setDescriptionProduit($description_produit)
    {
        $this->description_produit = $description_produit;

        return $this;
    }

    public function getPrixProduit()
    {
        return $this->prix_produit;
    }

    public function setPrixProduit($prix_produit)
    {
        $this->prix_produit = $prix_produit;

        return $this;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    public function getStock()
    {
        return $this->stock;
    }

    public function setStock($stock)
    {
        $this->stock = $stock;

        return $this;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    public function getCaracteristique()
    {
        return $this->caracteristiques;
    }

    public function setCaracteristique($caract)
    {
        $this->caracteristiques = $caract;
        return $this;
    }

    public function getEntretien()
    {
        return $this->entretien;
    }

    public function setEntretien($entretien)
    {
        $this->entretien = $entretien;
        return $this;
    }

    public function getCategorie()
    {
        return $this->categorie;
    }

    public function setCategorie($categoryId)
    {
        $this->categorie = $categoryId;

        return $this;
    }

    public function getLot()
    {
        return $this->lot;
    }

    public function setLot($lot)
    {
        $this->lot = $lot;

        return $this;
    }

    public function getImageId()
    {
        return $this->image_id;
    }

    public function setImageId($image_id)
    {
        $this->image_id = $image_id;

        return $this;
    }
}