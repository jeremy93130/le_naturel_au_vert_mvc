<?php

namespace Service;

use Model\Entity\User;
use Model\Repository\AvisRepository;
use Model\Repository\CommandeRepository;

class AvisManager
{
    public static function getMoyenne($id)
    {
        $avisRepository = new AvisRepository;
        $avis = $avisRepository->getAvisFromProduct($id);
        if(!empty($avis)){
            $totalAvis = 0;
            if(count($avis) > 1){
                foreach($avis as $a){
                    $totalAvis += $a->getNote();
                }
                return $totalAvis / count($avis);
            } else {
              return $avis[0]->getNote();
            }        
        }
    }

    public static function stars(int $note)
    {
            $etoiles = '';
            for ($i = 0; $i < $note; $i++) {
                $etoiles .= htmlspecialchars('<i class="fa-solid fa-star"></i>');
            }
    
            for ($i = $note; $i < 5; $i++) {
                $etoiles .= htmlspecialchars('<i class="fa-regular fa-star"></i>');
            }
        return $etoiles;
    }

    public static function formatDateAvis(array $avis)
    {
        foreach($avis as $a){
            $newDate = new \DateTime($a->getDate_Avis());
            $formatFr = $newDate->format('d-m-Y');
            $a->setDate_avis($formatFr);
        }
        return $avis;
    }

    public static function getEtoiles(array $avis)
    {
        $etoiles = [];
        foreach($avis as $a){
            $etoiles[] = self::stars($a->getNote());
        }

        return $etoiles;
    }

    public static function checkUserAchat(int $userId, int $produitId)
    {
        $commandeAchat = new CommandeRepository;

        $achat = $commandeAchat->checkAchatByUser($userId,$produitId);

        return $achat;
    }
}
