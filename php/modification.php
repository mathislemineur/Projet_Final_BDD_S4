<?php

session_start();

require_once("../includes/config-bdd-pokedex.php");
require_once("functions-DB.php");
require_once("functions_query.php");

$id_dresseur = $_SESSION['id_dresseur'];
$id_pokemon = $_POST['id_pokemon'];
$nb_vue = $_POST['nb_vue'];
$nb_attrape = $_POST['nb_attrape'];

if ($nb_attrape > $nb_vue) {

    header("Location: ../modif_dex.php?error=tricheur");
    exit();
}

if (isset($id_dresseur, $id_pokemon, $nb_vue, $nb_attrape)) {

    $mysqli = connectionDB();

    // modif la base selon le choix du dresseur
    modifDex($mysqli, $id_dresseur, $id_pokemon, $nb_vue, $nb_attrape);

    closeDB($mysqli);

    header("Location: ../index.php?success=modif_reussie");
    exit();

} else {

    header("Location: ../modif_dex.php?error=infos_manquantes");
    exit();
}
?>