<?php
/**
 * Summary of namespace Controller
 */
namespace Controller;

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

    public function __construct()
    {
        $this->productRepository = new ProduitsRepository;
        $this->orderRepository = new CommandeRepository;
        $this->detailRepository = new DetailCommandeRepository;

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
        var_dump($data);
        $totalGeneral = $_SESSION['totalGeneral'];
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