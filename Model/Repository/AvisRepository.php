<?php

namespace Model\Repository;

use Model\Entity\Avis;
use Service\Session;

class AvisRepository extends BaseRepository
{
    public function insertAvis(Avis $avis)
    {
        try {

            $this->dbConnection->beginTransaction();
            $sql = "INSERT INTO `avis` (id_produit,id_user,avis) VALUES (:produit,:user,:avis)";

            $request = $this->dbConnection->prepare($sql);

            $request->bindValue(":produit", $avis->getProduit_id());
            $request->bindValue(":user", $avis->getUser_id());
            $request->bindValue(':avis', $avis->getAvis());

            $request = $request->execute();
            $idOrder = $this->dbConnection->lastInsertId();

            // Validez la transaction si tout s'est bien passé
            $this->dbConnection->commit();

            if ($request) {
                if ($request == 1) {
                    return $avis;
                }
                Session::addMessage("danger",  "Erreur : l'avis n'a pas été envoyé");
                return false;
            }
        } catch (\PDOException $e) {

            // En cas d'erreur, annulez la transaction
            $this->dbConnection->rollBack();
            echo "Erreur : " . $e->getMessage();
        }
    }


    public function updateAvis(Avis $avis)
    {
        $sql = "UPDATE avis
                SET id_produit = :produit_id, id_user = :userId, avis = :avis
                WHERE id = :id";
        $request = $this->dbConnection->prepare($sql);
        $request->bindValue(":produit_id", $avis->getProduit_id());
        $request->bindValue(":userId", $avis->getUser_id());
        $request->bindValue(":avis", $avis->getAvis());
        $request = $request->execute();
        if ($request) {
            if ($request == 1) {
                Session::addMessage("success", "Votre avis a bien été mis à jour");
                return true;
            }
            Session::addMessage("danger", "Erreur : l'avis n'a pas pu être mis à jour");
            return false;
        }
        Session::addMessage("danger", "Erreur SQL");
        return null;
    }

    public function countAvis()
    {
        $sql = "SELECT COUNT(*) FROM avis";

        $request = $this->dbConnection->prepare($sql);
        $request->execute();

        if ($request) {
            $result = $request->fetch(\PDO::FETCH_ASSOC);

            if ($result !== false) {
                return $result;
            } else {
                return false;
            }
        }
    }

    public function getAvisByProduit(int $id)
    {
        $sql = "SELECT *,user.* FROM avis LEFT JOIN user ON avis.id_user = user.id WHERE id_produit = :id";

        $request = $this->dbConnection->prepare($sql);
        $request->bindValue(':id', $id);
        $request->execute();

        $result = $request->fetchAll(\PDO::FETCH_ASSOC);

        if ($result !== false) {
            return $result;
        } else {
            return false;
        }
    }
}
