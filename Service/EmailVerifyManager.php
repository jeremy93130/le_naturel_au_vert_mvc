<?php

namespace Service;

require_once 'vendor/autoload.php';
use Dotenv\Dotenv;
use Model\Entity\User;
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
        if ($result['data']['result'] !== 'deliverable') {
            Session::addMessage("danger", "L'adresse mail entrée n'existe pas, merci d'en saisir une nouvelle.");
            return false;
        }
    }
}
