<?php

namespace Model\Repository;

use Model\Entity\User;
use PDOException;
use Service\Session;

class UserRepository extends BaseRepository
{
    public function checkUserExist($email)
    {
        $request = $this->dbConnection->prepare("SELECT COUNT(*) FROM user WHERE email = :email");
        $request->bindParam(":email", $email);

        $request->execute();
        $count = $request->fetchColumn();
        return $count > 1 ? true : false;
    }

    public function insertUser(User $user)
    {
        try {

            $sql = "INSERT INTO user (nom, prenom, email, mot_de_passe, date_de_naissance, telephone, roles) VALUES (:lastname, :firstname, :email,:password, :birthday, :telephone,:role)";
            $request = $this->dbConnection->prepare($sql);
            $request->bindValue(":lastname", $user->getNom());
            $request->bindValue(":firstname", $user->getPrenom());
            $request->bindValue(":email", $user->getEmail());
            $request->bindValue(":password", $user->getPassword());
            $request->bindValue(":birthday", $user->getBirthday());
            $request->bindValue(":telephone", $user->getPhone());
            $request->bindValue(":role", $user->getRole());

            $request = $request->execute();
            if ($request) {
                if ($request == 1) {
                    Session::addMessage("success", "Votre inscription s'est bien déroulée");
                    return true;
                } else {
                    Session::addMessage("danger", "Erreur : Il y'a eu un problème lors de votre inscription");
                    return false;
                }
            }
        } catch (PDOException $e) {
            if ($e->getCode() == 23000) { // Code erreur pour violation de contrainte d'unicité
                Session::addMessage("danger", "Erreur : Cet email est déjà utilisé");
            }
            return false;
        }
    }


    public function updateUser(User $user)
    {
        $sql = "UPDATE user 
                SET nom = :lastname, prenom = :firstname, email = :email, mot_de_passe = :password, date_de_naissance = :birthday, telephone = :telephone, roles = :role
                WHERE id = :id";
        $request = $this->dbConnection->prepare($sql);
        $request->bindValue(":id", $user->getId());
        $request->bindValue(":lastname", $user->getNom());
        $request->bindValue(":firstname", $user->getPrenom());
        $request->bindValue(":password", $user->getPassword());
        $request->bindValue(":birthday", $user->getBirthday());
        $request->bindValue(":telephone", $user->getPhone());
        $request->bindValue(":email", $user->getEmail());
        $request->bindValue(":role", $user->getRole());
        $request = $request->execute();
        if ($request) {
            if ($request == 1) {
                return true;
            }
            return false;
        }
        Session::addMessage("danger", "Erreur SQL");
        return null;
    }

    public function loginUser($email)
    {
        $request = $this->dbConnection->prepare("SELECT * FROM user WHERE email = :email");
        $request->bindParam(":email", $email);

        if ($request->execute()) {
            if ($request->rowCount() == 1) {
                $request->setFetchMode(\PDO::FETCH_CLASS, "Model\Entity\User");
                return $request->fetch();
            } else {
                return false;
            }
        } else {
            return null;
        }
    }
}
