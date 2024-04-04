<?php
/**
 * Summary of namespace Controller
 */
namespace Controller;

use Model\Entity\Adresse;
use Form\AdresseHandleRequest;

/**
 * Summary of OrderController
 */
class AdresseController extends BaseController
{
    private Adresse $adresse;
    private AdresseHandleRequest $adresseHandleRequest;

    public function __construct()
    {
        $this->adresse = new Adresse;
        $this->adresseHandleRequest = new AdresseHandleRequest;
    }

    public function index()
    {
        $data = file_get_contents('data/pays.json');
        $pays = json_decode($data, true);

        $dataVille = file_get_contents('data/cities.json');
        $ville = json_decode($dataVille, true);

        $this->adresseHandleRequest->handleInsertForm($this->adresse);


        if ($this->adresseHandleRequest->isSubmitted() && $this->adresseHandleRequest->isValid()) {
            $_SESSION['adresseValide'] = true;
            $_SESSION['adresseData'] = $this->adresseHandleRequest;
        }

        $this->render('adresse/adresse.html.php', [
            'pays' => $pays,
            'villes' => $ville
        ]);
    }

    public function edit($id)
    {

    }

    public function delete($id)
    {

    }

    public function show($id)
    {

    }
}