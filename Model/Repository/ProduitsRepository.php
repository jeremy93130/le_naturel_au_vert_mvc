<?php

namespace Model\Repository;

use Model\Entity\Produits;
use Model\Entity\User;
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
            Session::addMessage("success", "Le nouveau produit a bien été enregistré");
            return true;
        }
        Session::addMessage("danger", "Erreur : le produit n'a pas été enregisté");
        return false;
    }


    public function updateProduct(Produits $product)
    {
        $sql = "UPDATE produits SET ";
        $params = [];
        if ($product->getId() !== null) {
            $sql .= "id = :id, ";
            $params[':id'] = $product->getId();
        }
        if ($product->getNomProduit() !== null) {
            $sql .= "nom_produit = :nom, ";
            $params[':nom'] = $product->getNomProduit();
        }
        if ($product->getDescriptionProduit() !== null) {
            $sql .= 'description_produit = :description, ';
            $params[':description'] = $product->getDescriptionProduit();
        }
        if ($product->getPrixProduit() !== null) {
            $sql .= 'prix_produit = :prix, ';
            $params[':prix'] = $product->getPrixProduit();
        }
        if ($product->getStock() !== null) {
            $sql .= 'stock = :stock, ';
            $params[':stock'] = $product->getStock();
        }
        if ($product->getImage() !== null) {
            $sql .= 'image = :image, ';
            $params[':image'] = $product->getImage();
        }
        if ($product->getCaracteristique() !== null) {
            $sql .= 'caracteristiques = :caracteristique, ';
            $params[':caracteristique'] = $product->getCaracteristique();
        }
        if ($product->getEntretien() !== null) {
            $sql .= 'entretien = :entretien, ';
            $params[':entretien'] = $product->getEntretien();
        }
        if ($product->getCategorie() !== null) {
            $sql .= 'categorie = :categorie, ';
            $params[':categorie'] = $product->getCategorie();
        }
        if ($product->getLot() !== null) {
            $sql .= 'lot = :lot ';
            $params[':lot'] = $product->getLot();
        }
        $sql .= 'WHERE id = :id';
        $request = $this->dbConnection->prepare($sql);

        // Boucler pour lier les paramètres 
        foreach ($params as $key => $value) {
            $request->bindValue($key,$value);
        }
        $request = $request->execute();
        if ($request) {
            return true;
        }
        Session::addMessage("danger", "Erreur : Le produit n'a pas été mise à jour");
        return false;
    }

    public function paginate($limit, $offset)
    {
        $query = "SELECT * FROM produits LIMIT :limit OFFSET :offset";
        $statement = $this->dbConnection->prepare($query);
        $statement->bindValue(':limit', $limit);
        $statement->bindValue(':offset', $offset);
        $statement->execute();
        return $statement->fetchAll();
    }
}
