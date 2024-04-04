<?php

namespace Model\Repository;

use Model\Entity\Adresse;
use Service\Session;

class AdresseRepository extends BaseRepository
{
    public function insertAdresse()
    {
        $adresse = new Adresse;
        $adresse->setClient($_SESSION["user"]->getId());

        try {

            $this->dbConnection->beginTransaction();
            $sql = "INSERT INTO `adresse` (adresse,code_postal,ville,pays,instruction_livraison,client_id,nom_complet,commande_id,telephone,type) VALUES (:adresse,:codePostal,:ville,:pays,:instructions,:client,:nom,:commande,:telephone,:type)";

            $request = $this->dbConnection->prepare($sql);

            $request->bindValue(":adresse", $adresse->getAdresse());
            $request->bindValue(":codePostal", $adresse->getCodePostal());
            $request->bindValue(':ville', $adresse->getVille());
            $request->bindValue(':pays', $adresse->getPays());
            $request->bindValue(':instructions', $adresse->getInstruction_livraison());
            $request->bindValue(':client', $adresse->getClient());
            $request->bindValue('nom', $adresse->getNomComplet());
            $request->bindValue('commande', $adresse->getCommande());
            $request->bindValue('telephone', $adresse->getTelephone());
            $request->bindValue('type', $adresse->getType());

            $request = $request->execute();
            $idAdresse = $this->dbConnection->lastInsertId();

            // Validez la transaction si tout s'est bien passé
            $this->dbConnection->commit();

            if ($request) {
                if ($request == 1) {
                    return $idAdresse;
                }
                Session::addMessage("danger", "Erreur : la commande n'a pas été enregisté");
                return false;
            }
        } catch (\PDOException $e) {

            // En cas d'erreur, annulez la transaction
            $this->dbConnection->rollBack();
            echo "Erreur : " . $e->getMessage();
        }
    }


    public function updateOrder(Adresse $adresse)
    {
        $sql = "UPDATE adresse
                SET adresse = :adresse, client_id = :userId
                WHERE id = :id";
        $request = $this->dbConnection->prepare($sql);
        $request->bindValue(":adresse", $adresse->getAdresse());
        $request->bindValue(":userId", $adresse->getClient());
        $request = $request->execute();
        if ($request) {
            if ($request == 1) {
                Session::addMessage("success", "La mise à jour de la commande a bien été éffectuée");
                return true;
            }
            Session::addMessage("danger", "Erreur : la commande n'a pas été mise à jour");
            return false;
        }
        Session::addMessage("danger", "Erreur SQL");
        return null;
    }

}