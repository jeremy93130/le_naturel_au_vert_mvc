<?php

namespace Model\Repository;

use Model\Entity\Commande;
use Service\Session;

class CommandeRepository extends BaseRepository
{
    public function insertOrder()
    {        
        $order = new Commande;
        $order->setClientId($_SESSION["user"]->getId());

        try {
            
            $this->dbConnection->beginTransaction();
            $sql = "INSERT INTO `commande` (client_id,date_commande,etat_commande,total,numero_commande) VALUES (:client,NOW(),:etat,:total,:numero)";

            $request = $this->dbConnection->prepare($sql);

            $request->bindValue(":client", $order->getClientId());
            $request->bindValue(":etat", $order->getEtatCommande());
            $request->bindValue(':total', $order->getTotal());
            $request->bindValue(':numero', $order->getNumeroCommande());

            $request = $request->execute();
            $idOrder = $this->dbConnection->lastInsertId();
            
            // Validez la transaction si tout s'est bien passé
            $this->dbConnection->commit();

            if ($request) {
                if ($request == 1) {
                    return $idOrder;
                }
                Session::addMessage("danger",  "Erreur : la commande n'a pas été enregisté");
                return false;
            }
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