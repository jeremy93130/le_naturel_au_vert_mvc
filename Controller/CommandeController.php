<?php

/**
 * Summary of namespace Controller
 */

namespace Controller;

use Model\Entity\User;
use Model\Repository\AdresseRepository;
use Service\CommandeManager;
use Service\Session;

/**
 * Summary of OrderController
 */
class CommandeController extends BaseController
{

    private AdresseRepository $adresseRepository;
    private User $user;
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
        if (!isset($_SESSION['user'])) {
            $_SESSION['message_connexion'] = "Merci de vous connecter ou vous inscrire avant de valider votre panier";
            redirection(addLink('user', 'login'));
        }
        $data = $_SESSION['commande'];
        $totalGeneral = $_SESSION['totalGeneral'];
        $adresse_livraison = isset($_SESSION['adresse_livraison']) ? $_SESSION['adresse_livraison'] : ($this->adresseRepository->findByIdAndType($this->getUser(), 'livraison') ?? null);
        $adresse_facturation = isset($_SESSION['adresse_facturation']) ? $_SESSION['adresse_facturation'] : (isset($_SESSION['adresse_livraison']) ? $_SESSION['adresse_livraison'] : ($this->adresseRepository->findByIdAndType($this->getUser(), 'facturation')));

        $url = [
            'ids' => implode(',', array_column($data, 'id')),
            'total' => $totalGeneral,
        ];

        $this->render('commandes/commandes.html.php', [
            'data' => $data,
            'totalGeneral' => $totalGeneral,
            'adresse_livraison' => $adresse_livraison,
            'adresse_facturation' => $adresse_facturation,
            'url' => $url
        ]);
    }

    /**
     * Summary of edit
     * @param mixed $id
     * @return void
     */
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
