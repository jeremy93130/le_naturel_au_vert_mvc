<?php

/**
 * Summary of namespace Controller
 */

namespace Controller;

use Model\Entity\User;
use Model\Repository\UserRepository;
use Form\UserHandleRequest;
use Service\EmailVerifyManager;
use Service\Session;

/**
 * Summary of UserController
 */
class UserController extends BaseController
{
    private UserRepository $userRepository;
    private UserHandleRequest $form;
    private User $user;
    private EmailVerifyManager $emailVerifyManager;

    public function __construct()
    {
        $this->userRepository = new UserRepository;
        $this->form = new UserHandleRequest;
        $this->user = new User;
        $this->emailVerifyManager = new EmailVerifyManager;
    }

    public function new()
    {
        $user = $this->user;
        $this->form->handleInsertForm($user);
        if ($this->form->isSubmitted() && $this->form->isValid()) {
            $email = $this->emailVerifyManager->verifyEmail($user);

            if (!$email) {
                $_SESSION['infos_user_invalid_email'] = $user;
                return redirection(addLink('user', 'new'));
            }
            $register = $this->userRepository->insertUser($user);

            if (!$register) {
                // Rediriger vers la page précédente (page de création de l'utilisateur) en cas d'échec
                $_SESSION['infos_user_invalid_email'] = $user;
                return redirection(addLink('user', 'new'));
            }
            
            Session::delete('infos_user_invalid_email');
            Session::delete('password_inscription');
            if (isset($_SESSION['recapp_url'])) {
                return redirection(addLink($_SESSION['recapp_url']));
            }

            return redirection(addLink("user", 'login'));
        }

        $errors = $this->form->getEerrorsForm();

        return $this->render("user/register.html.php", [
            "h1" => "Inscription",
            "user" => $user,
            "errors" => $errors,
            'userInvalid' => $_SESSION['infos_user_invalid_email'] ?? null
        ]);
    }
    public function edit($id)
    {
        if (!empty($id) && is_numeric($id) && $this->getUser()) {
            $user = $this->getUser();

            $this->form->handleEditForm($user);

            if ($this->form->isSubmitted() && $this->form->isValid()) {
                $this->userRepository->updateUser($user);
                return redirection(addLink("home"));
            }

            $errors = $this->form->getEerrorsForm();
            return $this->render("user/form.html.php", [
                "h1" => "Update de l'utilisateur n° $id",
                "user" => $user,
                "errors" => $errors
            ]);
        }
        return redirection("/errors/404.php");
    }

    public function delete($id)
    {
        if (!empty($id) && $id && $this->getUser()) {
            if (is_numeric($id)) {

                $user = $this->user;
            } else {
                $this->setMessage("danger", "ERREUR 404 : la page demandé n'existe pas");
            }
        } else {
            $this->setMessage("danger", "ERREUR 404 : la page demandé n'existe pas");
        }

        $this->render("user/form.html.php", [
            "h1" => "Suppresion de l'user n°$id ?",
            "user" => $user,
            "mode" => "suppression"
        ]);
    }

    public function show($id)
    {
        if ($id) {
            if (is_numeric($id)) {
                $user = $this->user;
            } else {
                $this->setMessage("danger", "Erreur 404 : cette page n'existe pas");
            }
        } else {
            $this->setMessage("danger", "Erreur 403 : vous n'avez pas accès à cet URL");
            redirection(addLink("user", "list"));
        }

        $this->render("user/show.html.php", [
            "user" => $user,
            "h1" => "Fiche user"
        ]);
    }

    public function login()
    {

        if ($this->isUserConnected()) {
            /**
             * @var User
             */
            $user = $this->getUser();
            Session::addMessage('connexion', $user . 'Vous êtes déjà connecté(e)');
            return redirection(addLink("home", 'index'));
        }

        $this->form->handleLogin();

        if ($this->form->isSubmitted() && $this->form->isValid()) {
            /**
             * @var User
             */

            if (isset($_SESSION['url_commande'])) {
                unset($_SESSION['url_commande']);
                return redirection(addLink('commande', 'recapp'));
            }

            $user = $this->getUser();
            return redirection(addLink("home", 'index'));
        }

        $errors = $this->form->getEerrorsForm();

        return $this->render("security/login.html.php", [
            "h1" => "Entrez vos identifiants de connexion",
            "errors" => $errors

        ]);
    }

    public function logout()
    {
        $this->disconnection();
        $this->setMessage("success", "Vous êtes déconnecté");
        redirection(addLink("user", 'login'));
    }

    public function infoUser()
    {
        $user = $this->getUser();

        $this->render('info_utilisateur/infosUtilisateur.html.php', [
            'h1' => "Vos Informations personnelles",
            'user' => $user,
        ]);
    }

    public function infoUpdateUser()
    {
        $user = $this->getUser();
        $this->form->handleEditForm($user);
    }
}
