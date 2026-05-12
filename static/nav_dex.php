<nav>
    <ul>
<?php
session_start();

$id_poke = intval($_GET['id']);
$id_suivant = null;      
$id_precedent = null;

if (isset($_SESSION['id_dresseur'])) { // dresseur co
    require_once("./php/functions-DB.php");
    require_once("./php/functions_query.php");
    
    $flux = connectionDB();
    $captures = getCaptures($flux, $_SESSION['id_dresseur']);

    if (!empty($captures)) {

        // liste des ID des poke cpature, ils devinnent tous les int
        $liste_id_capture = array_map('intval', array_column($captures, 'id_pokemon'));
        
        // on tri au cas ou
        sort($liste_id_capture);

        // on se place sur le bon indice du tableau selon l'id du poke
        $ind_actuel = array_search($id_poke, $liste_id_capture);

        // si il y a un undice avant on peut reculer
        if (isset($liste_id_capture[$ind_actuel - 1])) {
            $id_precedent = $liste_id_capture[$ind_actuel - 1];
        }

        // si il y a un indice apres on peut avancer
        if (isset($liste_id_capture[$ind_actuel + 1])) {
            $id_suivant = $liste_id_capture[$ind_actuel + 1];
        }
    }

} else { // pas co

    if ($id_poke > 1) { // il n'y a pas de pokemon avec l'indice 0
        $id_precedent = $id_poke - 1; 
    }
    if ($id_poke < 151) { // on ne fait que la gen 1 pour le moment
        $id_suivant = $id_poke + 1; 
    }
}

// partie bouton du nav
if ($id_precedent !== null) { // il y a un precedent

    echo '<li><a href="pokemon.php?id=' . $id_precedent . '">Pokémon précédent</a></li>';

} else { // pas de precendent

    echo "<li><p>Aucun pokémon précédent</p></li>";

}

// le pokemon actuel
echo "<li><p>Détails du Pokémon n°" . $id_poke . "</p></li>";

if ($id_suivant !== null) { // il y a un suivant

    echo '<li><a href="pokemon.php?id=' . $id_suivant . '">Pokémon suivant</a></li>';

} else { // pas de suivant

    echo "<li><p>Aucun pokémon suivant</p></li>";

}
?>
    </ul>
</nav>