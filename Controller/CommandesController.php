<?php
/**
 * Summary of namespace Controller
 */
namespace Controller;

use Model\Repository\CommandeRepository;
use Model\Repository\ProduitsRepository;
use Model\Repository\DetailCommandeRepository;

/**
 * Summary of OrderController
 */
class OrderController extends BaseController
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

    public function confirm()
    {
        if(!$this->isUserConnected()){
            redirection(addLink("user", "login"));
        }
        if(!$_SESSION["cart"]){
            
            $this->setMessage("info",  "Votre panier est vide");
            $this->redirectToRoute(["cart", "show"]);
        }

        $cart = $_SESSION["cart"];
        
        $orderId = $this->orderRepository->insertOrder();
        
        foreach ($cart as $value) {   

            $this->detailRepository->insertDetail($value["product"]->getId(), $orderId, $value["quantity"]);
            
            $this->productRepository->updateQuantityInProduct($value["product"]->getId(), $value["quantity"]); 
        }
        $this->remove("cart");
        $this->remove("nombre");
        
        $this->setMessage("success", "Votre commande a été enregistrée");
        $this->redirectToRoute(["home"]);
    
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