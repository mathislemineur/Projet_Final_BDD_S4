<nav>
    <ul>

<?php

if (isset($_SESSION['id_dresseur']) && !empty($_SESSION['id_dresseur'])) { // quelqu'un est co

    echo "<li><p>Bienvenue " . $_SESSION['login'] . "</p></li>";
    echo '<li><a href="index.php">Home</a></li>';
    echo '<li><a href="modif_dex.php">Modifier</a></li>';
    echo '<li><a href="php/logout.php">Déconnexion</a></li>';

} else { // personne n'est co

    echo '<li><a href="index.php">Home</a></li>';
    echo '<li><a href="connection.php">Connexion</a></li>';
    echo '<li><a href="inscription.php">Inscription</a></li>';

}

?>
    </ul>
</nav>