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
$id_article = $_GET['id'];

// si ca exuste pas demi tour ou si c'est vide demi tour
if (isset($id_article) == false || $id_article == "") {
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

        <?php
        // on recup le titre et l'id de l'article pour le mettre dans le titre de la page
        $titre_article = getArticles($flux, $id_article)[0]['titre'];
        $id_article = getArticles($flux, $id_article)[0]['id_article'];
        echo "<title>" . $titre_article . "</title>";
        ?>
		
        <link rel="icon" type="image/jpg" href="images/bouboule.jpg">
		<link href="styles/all.css?v=1.1" rel="stylesheet">
	</head>
	
    <body>
	
		<?php include("static/header.php"); ?>
        <?php include("static/nav.php"); ?>
        <?php include("static/nav_dex.php"); ?>

        <section>

        <?php

        // affichage de l'article
	
		displayArticlesInfos(getInfosArticles($flux, $id_article));

        // affichage des avis de cet article

        $liste_avis = getListeAvis($flux, $id_article);

        if (!empty($liste_avis)) {
            foreach ($liste_avis as $avis) {

                

                displayInfosAvis(getInfosAvis($flux, $avis['id_avis']));
                //$test = getInfosAvis($flux, $avis['id_avis']);

                
            }
        }

        ?>
        
	    </section>

	</body>
	
<?php include("static/footer.php"); ?>
</html>