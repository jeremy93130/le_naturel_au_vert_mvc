<?php
namespace Model\Entity;

class Commande extends BaseEntity
{ 
    private $client_id;
    private $date_commande;
    private $etat_commande;
    private $total;
    private $numero_commande;

    public function __construct()
    {
        $this->etat_commande = EN_ATTENTE;
    }

    
    public function getClientId()
    {
        return $this->client_id;
    }
    
    public function setClientId($userId)
    {
        $this->client_id = $userId;
        
        return $this;
    }

    public function getDateCommande()
    {
        return $this->date_commande;
    }

    public function setDateCommande($date_commande)
    {
        $this->date_commande = $date_commande;
        return $this;
    }
    
    public function getEtatCommande()
    {
        return $this->etat_commande;
    }
    
    public function setEtatCommande($state = null)
    {
        
        $this->etat_commande = $state !== null ? $state : EN_ATTENTE;        
    
        return $this;
    }

    public function getTotal()
    {
        return $this->total;
    }

    public function setTotal($total)
    {
        $this->total = $total;
        return $this;
    }

    public function getNumeroCommande()
    {
        return $this->numero_commande;
    }

    public function setNumeroCommande()
    {
        $this->numero_commande = "CMD" . uniqid();
        return $this;
    }
}