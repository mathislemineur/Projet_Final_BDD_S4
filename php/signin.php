<?php

session_start();

//Import des fichiers nécessaires
require_once("functions-DB.php");
require_once("functions_query.php");
require_once("../includes/config-bdd-pokedex.php");

$flux = connectionDB();

// on recup les infos du formulaire
$nom = $_POST['login'];
$mdp = $_POST['password'];

// on verif si le nom est pas deja pris
if (checkExistance($flux, $nom)) { // il existe

    closeDB($flux);

    header("Location: ../connection.php?error=existedeja");
    exit();

} else { // il existe pas

    $inscription = insertDresseur($flux, $nom, $mdp);
    
    closeDB($flux);
         
    header("Location: ../connection.php?signup=inscrit");
    exit();
}

?>