<?php

/**
 * Summary of namespace Controller
 */

namespace Controller;

use Form\AdresseHandleRequest;
use Model\Repository\CommandeRepository;
use Model\Repository\ProduitsRepository;
use Model\Repository\DetailCommandeRepository;
use Service\CommandeManager;

/**
 * Summary of OrderController
 */
class CommandeController extends BaseController
{
    private ProduitsRepository $productRepository;
    private CommandeRepository $orderRepository;
    private DetailCommandeRepository $detailRepository;
    private AdresseHandleRequest $adresseHandleRequest;

    public function __construct()
    {
        $this->productRepository = new ProduitsRepository;
        $this->orderRepository = new CommandeRepository;
        $this->detailRepository = new DetailCommandeRepository;
        $this->adresseHandleRequest = new AdresseHandleRequest;
    }

    public function index()
    {
        $request_body = file_get_contents("php://input");

        $data = json_decode($request_body, true);

        CommandeManager::recapp($data);
    }

    public function recapp()
    {

        $data = $_SESSION['commande'];
        $totalGeneral = $_SESSION['totalGeneral'];
        
        if($this->adresseHandleRequest->isSubmitted() && $this->adresseHandleRequest->isValid()){
            d_die($_SESSION['adresse_livraison']);
        }

        $this->render('commandes/commandes.html.php', [
            'data' => $data,
            'totalGeneral' => $totalGeneral
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
