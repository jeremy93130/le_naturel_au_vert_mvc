<?php

/**
 * Summary of namespace Controller
 */

namespace Controller;

use Service\CommandeManager;

/**
 * Summary of OrderController
 */
class HistoriqueCommandesController extends BaseController
{

    public function index()
    {
        $commande = CommandeManager::history($this->getUser());
        // d_die($commande);
        $this->render('historique_commandes/historique.html.php', [
            'commande' => $commande
        ]);
    }

}