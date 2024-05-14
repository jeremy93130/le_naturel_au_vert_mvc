<?php

namespace Model\Repository;

use Model\Entity\Commande;
use Model\Entity\Produits;
use Model\Entity\User;
use Service\Session;

class CommandeRepository extends BaseRepository
{
    public function insertOrder(Commande $order)
    {

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
                    $order->setId($idOrder);
                    return $order;
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

    public function checkAchatByUser(int $userId, int $produitsId)
    {
        $sql = "
        SELECT COUNT(*) as count
        FROM details_commande dc
        JOIN commande c ON dc.commande_id = c.id
        WHERE c.client_id = :user_id
        AND dc.produit_id = :produit_id
    ";
        $request = $this->dbConnection->prepare($sql);
        $request->bindValue(':user_id', $userId);
        $request->bindValue(':produit_id', $produitsId);
        $request->execute();

        $result = $request->fetchColumn();

        if ($result > 0) {
            $sql = "SELECT COUNT(*) as count FROM avis WHERE id_produit = :id_produit AND id_user = :id_user";

            $request = $this->dbConnection->prepare($sql);
            $request->bindValue(':id_produit', $produitsId, \PDO::PARAM_INT);
            $request->bindValue(':id_user', $userId, \PDO::PARAM_INT);
            $request->execute();

            $avisCount = $request->fetchColumn();

            // Retourne true si l'utilisateur a acheté le produit et n'a pas encore laissé d'avis
            return $avisCount == 0;
        } else {
            return false;
        }
    }
}
