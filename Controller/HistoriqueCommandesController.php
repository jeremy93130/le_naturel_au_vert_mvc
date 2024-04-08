<?php

/**
 * Summary of namespace Controller
 */

namespace Controller;

use Model\Repository\DetailCommandeRepository;
use Service\CommandeManager;

/**
 * Summary of OrderController
 */
class HistoriqueCommandesController extends BaseController
{
    private DetailCommandeRepository $userAdresseCommandeRepository;
    public function __construct()
    {
        $this->userAdresseCommandeRepository = new DetailCommandeRepository;
    }

    public function index()
    {
        $commande = CommandeManager::history($this->getUser());
        // d_die($commande);    
        $this->render('historique_commandes/historique.html.php', [
            'commande' => $commande
        ]);
    }

}