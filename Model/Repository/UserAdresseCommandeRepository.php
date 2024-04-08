<?php

namespace Model\Repository;

use Service\Session;
use Model\Entity\User;
use Model\Entity\Adresse;
use Model\Entity\Commande;
use Model\Entity\Produits;

class UserAdresseCommandeRepository extends BaseRepository
{
    public function findByClient(User $user)
    {
        $request = $this->dbConnection->prepare("SELECT * FROM user_adress_commande WHERE client_id = :client");
        $request->bindValue(":client", $user->getId());

        if ($request->execute()) {
            $request->setFetchMode(\PDO::FETCH_CLASS, "Model\Entity\UserAdress");
            return $request->fetchAll();
        } else {
            return null;
        }
    }

    public function findByAdresse(Adresse $adresse)
    {
        $request = $this->dbConnection->prepare('SELECT * FROM user_adress_commande WHERE adresse_id = :adresse');
        $request->bindValue(":adresse", $adresse->getId());

        if ($request->execute()) {
            $request->setFetchMode(\PDO::FETCH_CLASS, 'Model\Entity\UserAdress');
        } else {
            return null;
        }
    }

    public function findByCommande(Commande $commande)
    {
        $request = $this->dbConnection->prepare('SELECT * FROM user_adress_commande WHERE commande_id = :commande');
        $request->bindValue(":commande", $commande->getId());

        if ($request->execute()) {
            $request->setFetchMode(\PDO::FETCH_CLASS, 'Model\Entity\UserAdress');
        } else {
            return null;
        }
    }

    public function insertUserAdressCommande(User $user, Adresse $adresse, Commande $commande)
    {
        $sql = "INSERT INTO user_adress_commande (user_id,adresse_id,commande_id) VALUES (:user,:adresse,:commande)";
        $request = $this->dbConnection->prepare($sql);
        $request->bindValue(":user", $user->getId());
        $request->bindValue(":adresse", $adresse->getId());
        $request->bindValue(":commande", $commande->getId());

        $request = $request->execute();
        if ($request) {
            if ($request == 1) {
                Session::addMessage("success", "Le nouveau produit a bien été enregistré");
                return true;
            }
            Session::addMessage("danger", "Erreur : le produit n'a pas été enregisté");
            return false;
        }
        Session::addMessage("danger", "Erreur SQL");
        return null;
    }

}