<?php

/**
 * Summary of namespace Controller
 */

namespace Controller;

use Model\Entity\User;
use Model\Repository\AdresseRepository;
use Service\AdresseManager;
use Service\CommandeManager;


class CommandeController extends BaseController
{

    private AdresseRepository $adresseRepository;
    public function __construct()
    {
        $this->adresseRepository = new AdresseRepository;
    }

    public function index()
    {

        $request_body = file_get_contents("php://input");

        $data = json_decode($request_body, true);

        CommandeManager::recapp($data);
    }

    public function recapp()
    {
        // unset($_SESSION['adresse_livraison']);
        $_SESSION['adresseValide'] = null;
        if (!isset($_SESSION['user'])) {
            $_SESSION['message_connexion'] = "Merci de vous connecter ou vous inscrire avant de valider votre panier";
            $_SESSION['url_commande'] = true;
            redirection(addLink('user', 'login'));
        }
        $data = $_SESSION['commande'] ?? null;
        $totalGeneral = $_SESSION['totalGeneral'];

        $adresses = AdresseManager::checkAdresse($this->getUser(), $this->adresseRepository);

        if ($adresses) {
            $adresse_livraison = $adresses['livraison'];
            $adresse_facturation = $adresses['facturation'];
        }

        if ($data !== null && is_array($data)) {
            $url = [
                'ids' => implode(',', array_column($data, 'id')),
                'total' => $totalGeneral,
            ];
        } else if ($data == null) {
            $this->redirectToRoute(['home', 'index']);
        }

        $this->render('commandes/commandes.html.php', [
            'data' => $data,
            'totalGeneral' => $totalGeneral,
            'adresse_livraison' => $adresse_livraison ?? null,
            'adresse_facturation' => $adresse_facturation ?? null,
            'url' => $url ?? null
        ]);
    }

    public function confirmation()
    {
        if (!isset($_SESSION['confirmation_paiement'])) {
            $this->redirectToRoute(['home', 'index']);
        }
        $this->render('commandes/confirmation_commande.html.php', []);
    }

    public function edit($id)
    {
    }

    public function delete($id)
    {
    }

    public function show($id)
    {
    }
}
