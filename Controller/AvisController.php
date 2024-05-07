<?php

namespace Controller;

use Model\Entity\Avis;
use Model\Repository\AvisRepository;
use Model\Repository\ProduitsRepository;
use Service\AvisManager;
use Service\BackgroundManager;

class AvisController extends BaseController
{
    private AvisRepository $avisRepository;
    private ProduitsRepository $produitsRepository;

    public function __construct()
    {
        $this->avisRepository = new AvisRepository;
        $this->produitsRepository = new ProduitsRepository;
    }
    public function show($id)
    {
        $avis = $this->avisRepository->getAvisByProduit($id);
        // d_die($avis);
        $detailsProduit = $this->produitsRepository->findById('produits', $id);
        $css = BackgroundManager::getBackGround($detailsProduit->getCategorie());
        $cheminDossier = BackgroundManager::chooseProductFolder($detailsProduit->getCategorie());

        $etoile = AvisManager::getEtoiles($avis); 

        $avis = AvisManager::formatDateAvis($avis);
        return $this->render('avis/avis.html.php', [
            'avis' => $avis,
            'produit' => $detailsProduit,
            'css' => $css,
            'cheminDossier' => $cheminDossier,
            'etoile' => $etoile
        ]);
    }

    public function new()
    {
        
        return $this->render('avis/formulaire_avis.html.php', []);
    }
}
