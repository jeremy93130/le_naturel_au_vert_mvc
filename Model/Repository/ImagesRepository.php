<?php

namespace Model\Repository;

use Model\Entity\Images;
use Model\Entity\Produits;
use Service\Session;

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

        } catch (\PDOException $e) {
            // En cas d'erreur, annulez la transaction

            $this->dbConnection->rollBack();
            echo "Erreur : " . $e->getMessage();
        }
    }
}