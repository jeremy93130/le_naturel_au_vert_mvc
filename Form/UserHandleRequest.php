<?php

namespace Form;

use Service\Session as Sess;
use Model\Entity\User;
use Model\Repository\UserRepository;

class UserHandleRequest extends BaseHandleRequest
{
    private $userRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository;
    }

    public function handleInsertForm(User $user)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            extract($_POST);
            $errors = [];

            if (!empty($nom)) {
                if (strlen($nom) < 2) {
                    $errors[] = "Le nom doit avoir au moins 2 caractères";
                }
                if (strlen($nom) > 30) {
                    $errors[] = "Le nom ne peut avoir plus de 30 caractères";
                }
            }
            if (!empty($prenom)) {
                if (strlen($prenom) < 2) {
                    $errors[] = "Le prénom doit avoir au moins 2 caractères";
                }
                if (strlen($prenom) > 30) {
                    $errors[] = "Le prénom ne peut avoir plus de 30 caractères";
                }
            }
            if (empty($password)) {
                $errors[] = "Le mot de passe ne peut pas être vide";
            }


            if (empty($errors)) {
                $password = password_hash($password, PASSWORD_DEFAULT);
                $user->setPrenom($prenom ?? null);
                $user->setNom($nom ?? null);
                $user->setPassword($password);
                $user->setEmail($email);
                if (isset($role))
                    $user->setRole($role);
                return $this;
            }
            $this->setEerrorsForm($errors);
            return $this;
        }
    }

    public function handleEditForm(User $user)
    {
        if (isset($_POST)) {
            $nom = $_POST['nom'] ?? null;
            $prenom = $_POST['prenom'] ?? null;
            $email = $_POST['email'] ?? null;
            $telephone = $_POST['telephone'] ?? null;
            $ancienMdp = $_POST['ancienMdp'] ?? null;
            $nouveauMdp = $_POST['nouveauMdp'] ?? null;
            $champModifie = $_POST['champModifie'] ?? null;

            switch ($champModifie) {
                case 'nom':
                    $message = "Votre nom a bien été modifié";
                    break;
                case 'prenom':
                    $message = "Votre prenom a bien été modifié";
                    break;
                case 'email':
                    $message = "Votre email a bien été modifié";
                    break;
                case 'telephone':
                    $message = "Votre numéro de téléphone a bien été modifié";
                    break;
                default:
                    "Rien n'a été modifié";
            }

            // Vérifiez si les valeurs ne sont pas nulles avant de les utiliser
            $nom = $nom !== null ? $nom : $user->getNom();
            $prenom = $prenom !== null ? $prenom : $user->getPrenom();
            $email = $email !== null ? $email : $user->getEmail();
            $telephone = $telephone !== null ? ($telephone) : $user->getPhone();
            $ancienMdp = $ancienMdp !== null ? trim($ancienMdp) : '';
            $nouveauMdp = $nouveauMdp !== null ? trim($nouveauMdp) : '';



            $user->setNom($nom);
            $user->setPrenom($prenom);
            $user->setEmail($email);
            $user->setPhone($telephone);

            $erreur_mdp = null;
            //Hasher le mdp :
            if (!empty($ancienMdp)) {
                // Vérifier l'ancien mot de passe
                if (password_verify($ancienMdp, $user->getPassword())) {
                    // Le mot de passe actuel est correct, procédez à la mise à jour
                    $hashedPassword = password_hash($nouveauMdp, PASSWORD_DEFAULT);
                    $user->setPassword($hashedPassword);
                } else {
                    echo json_encode(['erreur_mdp' => 'Ancien mot de passe incorrect']);
                }
            }

            $this->userRepository->updateUser($user);

            $success_message = "Vos informations ont bien été enregistrées";
            echo json_encode(['erreur_mdp' => $erreur_mdp ?? null, 'success_message' => $success_message ?? null, 'message' => $message ?? null]);
        }
    }
    public function handleLogin()
    {
        if (($_SERVER['REQUEST_METHOD'] === 'POST') && isset($_POST["login"])) {
            extract($_POST);
            $errors = [];
            if (empty($email) || empty($password)) {
                $errors[] = "Veuillez inserer vos coordonnées";
            } else {
                /**
                 * @var User
                 */
                $user = $this->userRepository->loginUser($email);
                if (empty($user)) {
                    $errors[] = "Il n'y a pas d'utilisateur avec cet email";
                } else {
                    if (!password_verify($password, $user->getPassword())) {
                        $errors[] = "Le mot de passe ne correspond pas";
                    }
                }
            }
            if (empty($errors)) {
                Sess::authentication($user);
                return $this;
            }

            $this->setEerrorsForm($errors);
            return $this;
        }
    }
}