<?php

session_start();

//Import des fichiers nécessaires
require_once("./includes/config-bdd-pokedex.php");      //config base de données
require_once("./includes/constantes.php");      		//constantes du site
require_once("./php/functions-DB.php");         		//fonctions pour la BDD
require_once("./php/functions_query.php");				//fonctions pour le pokedex
require_once("./php/functions_structure.php");			//fonctions pour structurer l'affichage

//Connexion à la base de données
$flux = connectionDB();

// on recup l'id du pokemon dans le lien
$id_user = $_GET['id'];

// si ca existe pas demi tour ou si c'est vide demi tour
if (isset($id_user) == false || $id_user == "") {
    header('Location: index.php');
    exit(); 
}

?>

<!DOCTYPE html>
<html lang="fr">
    <head>
		<meta name="keywords" content="esir,CUPGE,rennes">
		<meta name="author" content="Mathis_Le_Mineur">
		
        <meta charset="utf-8">

        <title> Profil </title>
		
        <link rel="icon" type="image/jpg" href="images/bouboule.jpg">
		<link href="styles/all.css?v=1.1" rel="stylesheet">
	</head>
	
    <body>
	
		<?php include("static/header.php"); ?>
        <?php include("static/nav.php"); ?>

        <section>

        <?php

        // infos du user
        displayInfosUser(getInfoUser($flux, $id_user));
        
        // balise pour le css 
        echo '<div class="user-avis">';

        // nb d'avis
        $nb_avis = count(getListeAvisUser($flux, $id_user));
        echo "<p> Nombre d'avis : " . $nb_avis . "</p>";

        // avis ecrits
        $liste_avis = getListeAvisUser($flux, $id_user);

        if (!empty($liste_avis)) {
            foreach ($liste_avis as $avis) {

                displayInfosAvis(getInfosAvis($flux, $avis['id_avis']));                
            }
        }

        // balise fermant le div du debut
        echo '</div>';

        // nb d'articles si redacteur ou admin

        ?>
        
	    </section>

	</body>
	
<?php include("static/footer.php"); ?>
</html>