<?php

namespace Service;

require_once 'vendor/autoload.php';
use Dotenv\Dotenv;
use Model\Entity\User;
use Model\Repository\UserRepository;

/**
 * Summary of ProductController
 */
class EmailVerifyManager
{

    public function verifyEmail(User $user)
    {
        $email = $user->getEmail();
        $dot = Dotenv::createImmutable(dirname(__DIR__));
        $dot->load();

        $cle_email = $_ENV['CLE_EMAIL'];

        $apiKey = $cle_email;

        $url = "https://api.hunter.io/v2/email-verifier?email={$email}&api_key={$apiKey}";

        $response = file_get_contents($url);
        $result = json_decode($response, true);
        // Vérifier si l'e-mail est valide selon l'API Hunter.io
        if ($result['data']['status'] !== 'valid') {
            Session::addMessage("danger", "L'adresse mail entrée n'existe pas, merci d'en saisir une nouvelle.");
            return false;
        }
        return true;
    }

    public function checkExistingEmail(User $user, UserRepository $userRepository)
    {
        $emailVerified = $user->getEmail();

        $emailVerfiying = $userRepository->findByAttributes('user', ['email' => $emailVerified]);

        if($emailVerfiying){
            Session::addMessage('danger', 'Il y\'a déjà un compte possédant cet Email, merci d\'en choisir une autre');
        }
    }
}
