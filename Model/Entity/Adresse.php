<?php

namespace App\Entity;

use Model\Entity\User;
use Model\Entity\Commande;
use Model\Entity\BaseEntity;

class Adresse extends BaseEntity
{
    private  $nomComplet;
    private  $adresse;
    private ?int $codePostal;
    private  $ville;
    private  $pays;
    private  $instruction_livraison;
    private $client_id;
    private  $telephone;
    private  $type;
    private $userAdresseCommande_id;
    private $commande_id;

    public function getNomComplet(): string
    {
        return $this->nomComplet;
    }

    public function setNomComplet(?string $nomComplet): static
    {
        $this->nomComplet = $nomComplet;
        return $this;
    }

    public function getAdresse(): string
    {
        return $this->adresse;
    }

    public function setAdresse(?string $adresse): static
    {
        $this->adresse = $adresse;
        return $this;
    }

    public function getCodePostal(): int
    {
        return $this->codePostal;
    }

    public function setCodePostal(?int $codePostal): static
    {
        $this->codePostal = $codePostal;
        return $this;
    }

    public function getVille()
    {
        return $this->ville;
    }

    public function setVille(?string $ville): static
    {
        $this->ville = $ville;

        return $this;
    }

    public function getPays():string
    {
        return $this->pays;
    }

    public function setPays(?string $pays):static
    {
        $this->pays = $pays;

        return $this;
    }

    public function getInstruction_livraison()
    {
        return $this->instruction_livraison;
    }

    public function setInstruction_livraison($instruction_livraison)
    {
        $this->instruction_livraison = $instruction_livraison;

        return $this;
    }

    public function getClient()
    {
        return $this->client_id;
    }

    public function setClient($client)
    {
        $this->client_id = $client;

        return $this;
    }

    public function getTelephone()
    {
        return $this->telephone;
    }

    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    public function getUserAdresseCommande()
    {
        return $this->userAdresseCommande_id;
    }

    public function setUserAdresseCommande($userAdresseCommande)
    {
        $this->userAdresseCommande_id = $userAdresseCommande;

        return $this;
    }

    public function getCommande()
    {
        return $this->commande_id;
    }

    public function setCommande($commande)
    {
        $this->commande_id = $commande;

        return $this;
    }
}