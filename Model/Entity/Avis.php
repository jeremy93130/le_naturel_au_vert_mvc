<?php

namespace Model\Entity;

use Model\Entity\BaseEntity;

class Avis extends BaseEntity
{
    private int $produit_id;
    private int $user_id;
    private string $avis;
    private int $note;
    private $date_avis;
    private string $titre_avis;

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

    public function getNote()
    {
        return $this->note;
    }

    public function setNote($note)
    {
        $this->note = $note;

        return $this;
    }


    public function getTitre_avis()
    {
        return $this->titre_avis;
    }

    public function setTitre_avis($titre_avis)
    {
        $this->titre_avis = $titre_avis;

        return $this;
    }

    public function getDate_avis()
    {
        return $this->date_avis;
    }

    public function setDate_avis($date_avis)
    {
        $this->date_avis = $date_avis;

        return $this;
    }
}
