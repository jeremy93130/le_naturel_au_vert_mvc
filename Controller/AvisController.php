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

        $etoile = AvisManager::stars($avis[0]->getNote());
        // d_die($avis);
        return $this->render('avis/avis.html.php', [
            'avis' => $avis,
            'produit' => $detailsProduit,
            'css' => $css,
            'cheminDossier' => $cheminDossier,
            'etoile' => $etoile
        ]);
    }
}
