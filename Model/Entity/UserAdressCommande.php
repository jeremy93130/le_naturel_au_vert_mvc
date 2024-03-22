<?php

namespace App\Entity;

use Model\Entity\User;
use Model\Entity\Commande;

class UserAdresseCommande
{
    private ?User $user;
    private ?Adresse $adresse;
    private ?Commande $commande;

    public function __construct()
    {
        $this->user = new User;
        $this->adresse = new Adresse;
        $this->commande = new Commande;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;
        return $this;
    }

    public function getAdresse(): ?Adresse
    {
        return $this->adresse;
    }

    public function setAdresse(?Adresse $adresse): static
    {
        $this->adresse = $adresse;
        return $this;
    }

    public function getCommande(): ?Commande
    {
        return $this->commande;
    }

    public function setCommande(?Commande $commande): static
    {
        $this->commande = $commande;
        return $this;
    }

}