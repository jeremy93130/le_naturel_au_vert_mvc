<?php

namespace Controller;

class AvisController extends BaseController
{
    private $id_user;
    private $id_produits;
    private $avis;



    public function getId_user()
    {
        return $this->id_user;
    }


    public function setId_user($id_user)
    {
        $this->id_user = $id_user;

        return $this;
    }


    public function getId_produits()
    {
        return $this->id_produits;
    }

    public function setId_produits($id_produits)
    {
        $this->id_produits = $id_produits;

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
