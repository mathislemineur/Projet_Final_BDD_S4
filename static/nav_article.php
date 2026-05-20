<nav>
    <ul>
<?php
session_start();

$id_article = intval($_GET['id']);
$id_suivant = null;      
$id_precedent = null;

require_once("./php/functions-DB.php");
require_once("./php/functions_query.php");
    
$flux = connectionDB();
$nb_articles = getNombreArticles($flux)[0]['nb_articles'];

if ($id_article > 1) { // il n'y a pas d article avec l'indice 0
    $id_precedent = $id_article - 1; 
}
if ($id_article < $nb_articles) { 
    $id_suivant = $id_article + 1; 
}
if ($id_article == 1) { //  premier article
    $id_precedent = null; 
}
if ($id_article == $nb_articles) { // dernier article
    $id_suivant = null; 
}

// partie bouton du nav
if ($id_precedent !== null) { // il y a un precedent

    echo '<li><a href="article.php?id=' . $id_precedent . '">Article précédent</a></li>';

} else { // pas de precendent

    echo "<li><p>Aucun article précédent</p></li>";

}

// l article actuel
echo "<li><p>Détails de l'article n°" . $id_article . "</p></li>";

if ($id_suivant !== null) { // il y a un suivant

    echo '<li><a href="article.php?id=' . $id_suivant . '">Article suivant</a></li>';

} else { // pas de suivant

    echo "<li><p>Aucun article suivant</p></li>";

}
?>
    </ul>
</nav>