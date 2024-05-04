<?php

namespace Service;

use Model\Repository\AvisRepository;

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
}
