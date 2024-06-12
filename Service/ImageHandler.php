<?php

namespace Service;

use Model\Entity\Images;
use Service\Session as Sess;

class ImageHandler
{
    public static function handelPhoto(int $cat, $entity, $id = null)
    {
        $fileType = ["jpg", "jpeg", "png", "gif", "svg", "webp"];
        // Emplacement où vous souhaitez enregistrer le fichier
        $chemin = BackgroundManager::chooseProductFolder($cat);
        $target_dir = $chemin;
        // Construire un nom de fichier unique en ajoutant un horodatage au nom d'origine
        $originalFileName = basename($_FILES["image"]["name"]);
        $timestamp = time(); // Utilisation de l'horodatage actuel
        $uniqueFileName = $timestamp . "_" . $originalFileName;
        $target_file = $_SERVER['DOCUMENT_ROOT'] . $target_dir . $uniqueFileName;
        // Obtenir le type de l'image
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        // Vérifier si le fichier est une image JPEG
        if (!in_array($imageFileType, $fileType)) {
            Sess::addMessage("errors", "Seules les images de types JPEG, png, gif et svg sont autorisées.");
        } else {
            // Vérifier la taille de l'image (par exemple, 1 Mo)
            if ($_FILES["image"]["size"] > 1000000) {
                Sess::addMessage("errors", "L'image est trop volumineuse. La taille maximale autorisée est de 10 Mo.");
            } else {
                // Déplacer le fichier téléversé vers le répertoire cible
                // d_die($target_file);
                move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
                if ($id !== null) {
                    $entity->setProduitId($id);
                }

                if($entity instanceof Images){
                    $entity->setImageName($uniqueFileName);
                    } else {
                    $entity->setImage($uniqueFileName);
                }

                
                Sess::addMessage("succes", "L'image a été téléversée avec succès.");
            }
        }
    }
}
