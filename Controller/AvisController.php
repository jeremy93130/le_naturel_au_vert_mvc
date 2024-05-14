<?php

namespace Controller;

use Form\AvisHandleRequest;
use Model\Entity\Avis;
use Model\Repository\AvisRepository;
use Model\Repository\ProduitsRepository;
use Service\AvisManager;
use Service\BackgroundManager;

class AvisController extends BaseController
{
    private AvisRepository $avisRepository;
    private ProduitsRepository $produitsRepository;
    private AvisHandleRequest $avisHandleRequest;

    public function __construct()
    {
        $this->avisRepository = new AvisRepository;
        $this->produitsRepository = new ProduitsRepository;
        $this->avisHandleRequest = new AvisHandleRequest;
    }

    public function new()
    {
        if($this->avisHandleRequest->isSubmitted() && $this->avisHandleRequest->isValid())
        {

        }
        return $this->render('avis/formulaire_avis.html.php', []);
    }
}
