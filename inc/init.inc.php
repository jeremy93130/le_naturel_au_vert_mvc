<?php

/* ⚠ Il faut inclure le fichier autoload AVANT d'exécuter la fonction session_start() sinon il y aura
        une error si on essaye de stocker un objet dans la variable superglobale $_SESSION */
require "autoload.php";
session_start();
include __DIR__ . "/functions.inc.php";
define("ROOT", "/le_naturel_au_vert_mvc/");
define("ROLE_USER", "ROLE_USER");
define("ROLE_ADMIN", "ROLE_ADMIN");
define("INSERTED", "Enregistrer");
define("UPDATED", "Modifier");
define("DELETED", "Supprimer");
define("UPLOAD_LOGOS_IMG", "uploads/logos/");
define("UPLOAD_PLANTES_IMG", "uploads/plantes/");
define("UPLOAD_GRAINES_IMG", "uploads/graines/");
define("UPLOAD_LEGUMES_IMG", "uploads/legumes/");
define("UPLOAD_FRUITS_IMG", "uploads/fruits/");
define("EN_ATTENTE", "En Attente");