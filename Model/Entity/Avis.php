<?php

namespace Model\Entity;

use Model\Entity\BaseEntity;

class Avis extends BaseEntity
{
    private int $produit_id;
    private int $user_id;
    private string $avis;

    public function getProduit_id()
    {
        return $this->produit_id;
    }


    public function setProduit_id($produit_id)
    {
        $this->produit_id = $produit_id;

        return $this;
    }


    public function getUser_id()
    {
        return $this->user_id;
    }


    public function setUser_id($user_id)
    {
        $this->user_id = $user_id;

        return $this;
    }

    public function getAvis()
    {
        return $this->avis;
    }

    public function setAvis($avis)
    {
        $this->avis = $avis;

        return $this;
    }
}