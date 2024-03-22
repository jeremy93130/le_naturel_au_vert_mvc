<?php

namespace App\Entity;
use Model\Entity\BaseEntity;

class Images extends BaseEntity
{
    private $produit_id;
    private $image_name;

    public function getProduitId()
    {
        return $this->produit_id;
    }

    public function setProduitId($produit)
    {
        $this->produit_id = $produit;
        return $this;
    }

    public function getImageName()
    {
        return $this->image_name;
    }

    public function setImageName($image)
    {
        $this->image_name = $image;
        return $this;
    }
}