<?php
/**
 * Summary of namespace Controller
 */
namespace Controller;

use Form\AdresseFacturationHandleRequest;
use Model\Entity\Adresse;
use Form\AdresseLivraisonHandleRequest;

/**
 * Summary of OrderController
 */
class AdresseController extends BaseController
{
    private Adresse $adresse;
    private AdresseLivraisonHandleRequest $adresseLivraisonHandleRequest;
    private AdresseFacturationHandleRequest $adresseFacturationHandleRequest;

    public function __construct()
    {
        $this->adresse = new Adresse;
        $this->adresseLivraisonHandleRequest = new AdresseLivraisonHandleRequest;
        $this->adresseFacturationHandleRequest = new AdresseFacturationHandleRequest;
    }

    public function adresseLivraison()
    {
        $data = file_get_contents('data/pays.json');
        $pays = json_decode($data, true);

        $dataVille = file_get_contents('data/cities.json');
        $ville = json_decode($dataVille, true);

        $this->adresseLivraisonHandleRequest->handleInsertForm($this->adresse);


        if ($this->adresseLivraisonHandleRequest->isSubmitted() && $this->adresseLivraisonHandleRequest->isValid()) {
            $_SESSION['adresseValide'] = true;
            $this->redirectToRoute(['commande', 'recapp']);
        }

        $this->render('adresse/adresse.html.php', [
            'pays' => $pays,
            'villes' => $ville
        ]);
    }

    public function adresseFacturation()
    {
        $data = file_get_contents('data/pays.json');
        $pays = json_decode($data, true);

        $dataVille = file_get_contents('data/cities.json');
        $ville = json_decode($dataVille, true);

        $this->adresseFacturationHandleRequest->handleInsertForm($this->adresse);


        if ($this->adresseLivraisonHandleRequest->isSubmitted() && $this->adresseFacturationHandleRequest->isValid()) {
            $this->redirectToRoute(['commande', 'recapp']);
        }

        $this->render('adresse/adresse_facture.html.php', [
            'pays' => $pays,
            'villes' => $ville
        ]);
    }

    public function delete($id)
    {

    }

    public function show($id)
    {

    }
}