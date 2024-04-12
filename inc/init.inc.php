<?php

/* ⚠ Il faut inclure le fichier autoload AVANT d'exécuter la fonction session_start() sinon il y aura
        une error si on essaye de stocker un objet dans la variable superglobale $_SESSION */

// On autorise la Session a avoir 1 an de "vie"

// Définir la durée maximale de vie de la session à 1 heure
$sessionLifetime = 31536000; // 1 an

// Définir les paramètres de cookie de session
session_set_cookie_params($sessionLifetime);

// Définir la durée maximale de vie de la session
ini_set('session.gc_maxlifetime', $sessionLifetime);

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