<?php

namespace Service;

use Model\Entity\Produits;
use Model\Repository\ProduitsRepository;

class BackgroundManager
{
    public static function getBackGround($categorie) {
        $cssClass = 'achat-accueil';

        switch ($categorie) {
            case 1:
                $cssClass .= '-plantes';
                break;
            case 2:
                $cssClass .= '-graines';
                break;
            case 3:
                $cssClass .= '-legumes';
                break;
            case 4:
                $cssClass .= '-fruits';
                break;
            default:
                $cssClass .= '-defaut';
        }

        return $cssClass;
    }

    public static function chooseProductFolder($categorie){
        $cheminDossier = ROOT .
            ($categorie == 1 ? UPLOAD_PLANTES_IMG :
                ($categorie == 2 ? UPLOAD_GRAINES_IMG :
                    ($categorie == 3 ? UPLOAD_LEGUMES_IMG :
                        ($categorie == 4 ? UPLOAD_FRUITS_IMG : ""))));

        return $cheminDossier;
    }
}