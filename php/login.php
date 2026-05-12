<?php

session_start();

// echo "Login reçu : " . $_POST['login'] . "<br>";
// echo "Mot de passe reçu : " . $_POST['password'] . "<br>";

//Import des fichiers nécessaires
require_once("functions-DB.php");
require_once("functions_query.php");
require_once("../includes/config-bdd-pokedex.php"); // On remonte pour trouver la config

$flux = connectionDB();

// on recup les infos du formulaire
$nom = $_POST['login'];
$mdp = $_POST['password'];

// existes tu utilisateur ?
$verif = checkLogin($flux, $nom, $mdp);

// deconexion de la bdd
closeDB($flux);

// redirections
if (!empty($verif)) {

    // echo "L'utilisateur existe !";

    $_SESSION['id_dresseur'] = $verif[0]['id_dresseur'];
    $_SESSION['login'] = $verif[0]['nom_dresseur'];

    header("Location: ../index.php");
    exit();

} else {

    // echo "L'utilisateur n'existe pas !";
    
    header("Location: ../connection.php?error=problemmesdindentifiants");
    exit();
}

?>