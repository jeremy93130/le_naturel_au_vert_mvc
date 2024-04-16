<?php

namespace Model\Repository;

use PDOException;
use Service\Session;
use Model\Entity\User;
use Model\Entity\Adresse;

class AdresseRepository extends BaseRepository
{
    public function insertAdresse(Adresse $adresse)
    {

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
            $request->bindValue('commande', $adresse->getCommandeId());
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


    public function findByIdAndType($id, $type)
    {
        $sql = "SELECT * FROM adresse WHERE client_id = :id AND type = :type ORDER BY id DESC LIMIT 1";

        $request = $this->dbConnection->prepare($sql);
        $request->bindValue(':id', $id);
        $request->bindValue(':type', $type);

        try {
            $request->execute();
            $class = "Model\Entity\\" . ucfirst('Adresse');
            $request->setFetchMode(\PDO::FETCH_CLASS, $class);
            $result = $request->fetch();
            if (!$result) {
                return null;
            }
            if ($type == "livraison") {
                return $_SESSION['adresse_livraison'] = $result;
            } else if ($type == "facturation") {
                return $_SESSION['adresse_facturation'] = $result;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
            return null;
        }
    }


    public function findLastLivraison(int $user)
    {
        $sql = "SELECT * FROM adresse WHERE type='livraison' AND client_id=:user ORDER BY id DESC LIMIT 1";

        $request = $this->dbConnection->prepare($sql);
        $request->bindValue(":user", $user);

        try {
            $request->execute();
            $class = "Model\Entity\\" . ucfirst('adresse');
            $request->setFetchMode(\PDO::FETCH_CLASS, $class);
            $result = $request->fetch();

            if (!$result) {
                return null;
            }
            return $result;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function findLastFacturation(int $user)
    {
        $sql = "SELECT * FROM adresse WHERE type='facturation' AND client_id = :user ORDER BY id DESC LIMIT 1";

        $request = $this->dbConnection->prepare($sql);
        $request->bindValue(':user', $user);
        try {
            $request->execute();
            $class = "Model\Entity\\" . ucfirst('adresse');
            $request->setFetchMode(\PDO::FETCH_CLASS, $class);
            $result = $request->fetch();

            if (!$result) {
                return null;
            }
            return $result;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }


    public function findByCommande($id)
    {
        $sql = "SELECT * FROM adresse WHERE commande_id = :id";

        $request = $this->dbConnection->prepare($sql);
        $request->bindValue(':id', $id);

        try {
            $request->execute();
            $class = "Model\Entity\\" . ucfirst('adresse');
            $request->setFetchMode(\PDO::FETCH_CLASS, $class);

            return $request->fetchAll();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

}