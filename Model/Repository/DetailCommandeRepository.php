<?php

namespace Model\Repository;

use Service\Session;
use Model\Entity\User;
use Model\Entity\Order;
use Model\Entity\Commande;
use Model\Entity\DetailCommande;

class DetailCommandeRepository extends BaseRepository
{
    public function insertDetail($productId, $orderId, $quantity)
    {
        $detail = new DetailCommande;
        $detail->setQuantite($quantity)
            ->setCommandeId($orderId)
            ->setProduitId($productId);

        try {
            $this->dbConnection->beginTransaction();

            $sql = "INSERT INTO `details_commande` (quantite, commande_id, produit_id) VALUES (:quantity, :orderId, :productId)";

            $request = $this->dbConnection->prepare($sql);

            $request->bindValue(":quantity", $quantity);
            $request->bindValue(":orderId", $orderId);
            $request->bindValue(":productId", $productId);

            $request = $request->execute();

            // Validez la transaction si tout s'est bien passé
            $this->dbConnection->commit();

        } catch (\PDOException $e) {
            // En cas d'erreur, annulez la transaction

            $this->dbConnection->rollBack();
            echo "Erreur : " . $e->getMessage();
        }
    }

    public function findByUserAdresseCommande(User $user)
    {
        $sql = "SELECT * FROM details_commande dc
            LEFT JOIN produits p ON dc.produit_id = p.id
            LEFT JOIN commande c ON dc.commande_id = c.id
            LEFT JOIN user cl ON c.client_id = cl.id
            LEFT JOIN adresse a ON a.commande_id = c.id
            WHERE cl.id = :user";
        $request = $this->dbConnection->prepare($sql);
        $request->bindValue(':user', $user->getId());

        if ($request->execute()) {
            $request->setFetchMode(\PDO::FETCH_CLASS, "Model\Entity\DetailCommande");
            return $request->fetchAll();
        } else {
            return false;
        }
    }

}