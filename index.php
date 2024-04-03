<?php
require "inc/init.inc.php";

//URL: index.php?controller=user&method=update&id=32
// $variable = si la valeur est disponible elle sera égale à cette valeur , sinon elle prendra null ou une chaine de caractères en valeur
$admin = $_GET["doc"] ?? null;
$controller = $_GET["controller"] ?? "home";
$method = $_GET["method"] ?? "index";
$id = $_GET["id"] ?? null;

// Si la variable admin a une valeur, alors $classController prendra le chemin "Controller\\admin" en valeur et cherchera les controlleurs dans ce repertoire, sinon il ira dans les repertoires des controlleurs non-admin
if (!empty($admin)) {
    $classController = "Controller\\admin\\" . ucfirst($controller) . "Controller";
} else {
    $classController = "Controller\\" . ucfirst($controller) . "Controller";
}

//$classController = "Controller\\" . ucfirst($controller) . "Controller";  // ucfirst: met la première lettre d'un string en majuscule
/* $classController = "Controller\UserController" 
   $method = "list"
*/

/* On peut instancier un objet en utilisant un string pour le nom de la class.
    _⚠ le nom de la class doit être dans une variable pour pouvoir utiliser 'new'
*/

try {
    // Le nom de la classe étant dans le chemin , on peut l'instancier dans la variable directement :
    $controller = new $classController;

    $controller->$method($id);
} catch (Exception $e) {
    echo "Erreur : " . $e->getMessage();
}