<nav>
    <ul>

<?php

if (isset($_SESSION['id_user']) && !empty($_SESSION['id_user'])) { // quelqu'un est co

    echo "<li><p>Bienvenue " . $_SESSION['login'] . "</p></li>";
    echo '<li><a href="index.php">Home</a></li>';
    echo '<li><a href="profil.php?id=' . $_SESSION['id_user'] . '">Profil</a></li>';
    echo '<li><a href="php/logout.php">Déconnexion</a></li>';

} else { // personne n'est co

    echo '<li><a href="index.php">Home</a></li>';
    echo '<li><a href="connection.php">Connexion</a></li>';
    echo '<li><a href="inscription.php">Inscription</a></li>';

}

?>
    </ul>
</nav>