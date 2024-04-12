<?php

namespace Form;

use Model\Entity\Adresse;

class AdresseFacturationHandleRequest extends BaseHandleRequest
{
    public function handleInsertForm(Adresse $adresses)
    {
    }
    public function handleEditForm(Adresse $adresses)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['modif_adresse_facturation'])) {

            extract($_POST);
            $errors = [];
            // Vérification de la validité du formulaire
            if (empty($nomComplet)) {
                $errors[] = "Le nom ne peut pas être vide";
            }
            if (strlen($nomComplet) < 4) {
                $errors[] = "Le nom doit avoir au moins 4 caractères";
            }

            if (empty($errors)) {
                $adresses->setNomComplet($nomComplet)
                    ->setAdresse($adresse)
                    ->setCodePostal($codePostal)
                    ->setVille($ville)
                    ->setPays($pays)
                    ->setTelephone($telephone)
                    ->setInstruction_livraison(null)
                    ->setType('facturation');

                $_SESSION['adresse_facturation'] = $adresses;
                return $this;
            }


            $this->setEerrorsForm($errors);
            return $this;
        }
    }
}