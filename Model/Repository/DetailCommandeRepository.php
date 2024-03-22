<?php

namespace Model\Repository;

use Model\Entity\Commande;
use Model\Entity\Order;
use Model\Entity\DetailCommande;
use Service\Session;

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


    public function updateOrder(Commande $order)
    {
        $sql = "UPDATE commande 
                SET etat_commande = :state, client_id = :userId
                WHERE id = :id";
        $request = $this->dbConnection->prepare($sql);
        $request->bindValue(":id", $order->getId());
        $request->bindValue(":state", $order->getEtatCommande());
        $request->bindValue(":userId", $order->getClientId());
        $request = $request->execute();
        if ($request) {
            if ($request == 1) {
                Session::addMessage("success",  "La mise à jour de la commande a bien été éffectuée");
                return true;
            }
            Session::addMessage("danger",  "Erreur : la commande n'a pas été mise à jour");
            return false;
        }
        Session::addMessage("danger",  "Erreur SQL");
        return null;
    }

}