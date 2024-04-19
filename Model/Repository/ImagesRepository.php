<?php

namespace Model\Repository;


use PDO;
use PDOException;
use Service\Session;
use Model\Entity\Images;
use Model\Entity\Produits;

class ImagesRepository extends BaseRepository
{
    public function insertImages($productId, $image_name)
    {
        $images = new Images;
        $images->setProduitId($productId)
            ->setImageName($image_name);

        try {
            $this->dbConnection->beginTransaction();

            $sql = "INSERT INTO `images` (produit_id,image_name) VALUES (:produit,:image)";

            $request = $this->dbConnection->prepare($sql);

            $request->bindValue(":produit", $productId);
            $request->bindValue(":image", $image_name);

            $request = $request->execute();

            // Validez la transaction si tout s'est bien passé
            $this->dbConnection->commit();

        } catch (PDOException $e) {
            // En cas d'erreur, annulez la transaction

            $this->dbConnection->rollBack();
            echo "Erreur : " . $e->getMessage();
        }
    }

    public function carousselImages($id)
    {
        $sql = "SELECT * FROM images WHERE produit_id = :id";

        $request = $this->dbConnection->prepare($sql);
        $request->bindValue(':id', $id);
        try {
            $request->execute();
            $class = "Model\Entity\\" . ucfirst('Images');
            $request->setFetchMode(PDO::FETCH_CLASS, $class);
            $result = $request->fetchAll();
            if (!$result) {
                return null;
            }else {
                return $result;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
            return null;
        }
    }
}