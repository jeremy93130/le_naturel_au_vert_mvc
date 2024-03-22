<?php

namespace Model\Repository;

use Model\Entity\Produits;
use Service\Session;

class ProduitsRepository extends BaseRepository
{
    public function findByName($nom_produit)
    {
        $request = $this->dbConnection->prepare("SELECT * FROM produits WHERE nom_produit = :nom_produit");
        $request->bindParam(":nom_produit", $nom_produit);

        if ($request->execute()) {
            if ($request->rowCount() == 1) {
                $request->setFetchMode(\PDO::FETCH_CLASS, "Model\Entity\Product");
                return $request->fetch();
            } else {
                return false;
            }
        } else {
            return null;
        }
    }
    public function checkProductExist($nom_produit)
    {
        $request = $this->dbConnection->prepare("SELECT COUNT(*) FROM produit WHERE nom_produit = :nom_produit");
        $request->bindParam(":reference", $nom_produit);

        $request->execute();
        $count = $request->fetchColumn();
        return $count > 1 ? true : false;
    }

    public function insertProduct(Produits $product)
    {
        $sql = "INSERT INTO produits (nom_produit,description_produit,prix_produit,stock,image,caracteristiques,entretien,categorie,lot) VALUES (:nom,:description,:prix,:stock,:image,:carac,:entretien,:categorie,:lot)";
        $request = $this->dbConnection->prepare($sql);
        $request->bindValue(":nom", $product->getNomProduit());
        $request->bindValue(":description", $product->getDescriptionProduit());
        $request->bindValue(":prix", $product->getPrixProduit());
        $request->bindValue(":stock", $product->getStock());
        $request->bindValue(":image", $product->getImage());
        $request->bindValue(":carac", $product->getCaracteristique());
        $request->bindValue(':entretien', $product->getEntretien());
        $request->bindValue('categorie', $product->getCategorie());
        $request->bindValue('lot', $product->getLot());

        $request = $request->execute();
        if ($request) {
            if ($request == 1) {
                Session::addMessage("success", "Le nouveau produit a bien été enregistré");
                return true;
            }
            Session::addMessage("danger", "Erreur : le produit n'a pas été enregisté");
            return false;
        }
        Session::addMessage("danger", "Erreur SQL");
        return null;
    }


    public function updateProduct(Produits $product)
    {
        $sql = "UPDATE produits 
                SET nom_produit = :nom,description_produit=:description,prix_produit=:prix,stock=:stock,image=:image,caracteristiques=:caract,entretien=:entretien,categorie=:categorie,lot=:lot
                WHERE id = :id";
        $request = $this->dbConnection->prepare($sql);

        $request->bindValue(":id", $product->getId());
        $request->bindValue(":nom", $product->getNomProduit());
        $request->bindValue(":description", $product->getDescriptionProduit());
        $request->bindValue(":prix", $product->getPrixProduit());
        $request->bindValue(":stock", $product->getStock());
        $request->bindValue(":image", $product->getImage());
        $request->bindValue(":caract", $product->getCaracteristique());
        $request->bindValue(":entretien", $product->getEntretien());
        $request->bindValue(":categorie", $product->getCategorie());
        $request->bindValue(":lot", $product->getLot());

        $request = $request->execute();
        if ($request) {
            if ($request == 1) {
                Session::addMessage("success", "La mise à jour du produit a bien été éffectuée");
                return true;
            }
            Session::addMessage("danger", "Erreur : Le produit n'a pas été mise à jour");
            return false;
        }
        Session::addMessage("danger", "Erreur SQL");
        return null;
    }
    public function updateQuantityInProduct($productId, $stock)
    {
        $sql = "UPDATE produits 
                SET stock = stock - :stock
                WHERE id = :id";
        $request = $this->dbConnection->prepare($sql);

        $request->bindValue(":id", $productId);
        $request->bindValue(":stock", $stock);

        $request = $request->execute();
        if ($request) {
            if ($request == 1) {
                return true;
            }
            Session::addMessage("danger", "Erreur : Le produit n'a pas été mise à jour");
            return false;
        }
        Session::addMessage("danger", "Erreur SQL");
        return null;
    }

}