<?php
namespace Model\Entity;

class DetailCommande extends BaseEntity
{
    private $quantite;
    private $produit_id;
    private $commande_id;
    private Produits $produit;
    private Commande $commande;

    /**
     * Get the value of quantity
     */
    public function getQuantite()
    {
        return $this->quantite;
    }

    /**
     * Set the value of quantity
     *
     * @return  self
     */
    public function setQuantite($quantity)
    {
        $this->quantite = $quantity;

        return $this;
    }

    /**
     * Get the value of product_id
     */
    public function getProduitId()
    {
        return $this->produit_id;
    }

    /**
     * Set the value of product_id
     *
     * @return  self
     */
    public function setProduitId($productId)
    {
        $this->produit_id = $productId;

        return $this;
    }

    /**
     * Get the value of order_id
     */
    public function getCommandeId()
    {
        return $this->commande_id;
    }

    /**
     * Set the value of order_id
     *
     * @return  self
     */
    public function setCommandeId($orderId)
    {
        $this->commande_id = $orderId;

        return $this;
    }

    /**
     * Get the value of product_id
     */
    public function getProduit()
    {
        return $this->produit;
    }

    /**
     * Set the value of product_id
     *
     * @return  self
     */
    public function setProduit(Produits $produit)
    {
        $this->produit = $produit;

        return $this;
    }

    /**
     * Get the value of order_id
     */
    public function getCommande()
    {
        return $this->commande;
    }

    /**
     * Set the value of order_id
     *
     * @return  self
     */
    public function setCommande(Commande $order)
    {
        $this->commande = $order;

        return $this;
    }
}