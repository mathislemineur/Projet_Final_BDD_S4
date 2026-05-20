<?php

session_start();

//Import des fichiers nécessaires
require_once("./includes/config-bdd.php");      //config base de données
require_once("./includes/constantes.php");      //constantes du site
require_once("./php/functions-DB.php");         		//fonctions pour la BDD
require_once("./php/functions_query.php");				//fonctions pour le pokedex
require_once("./php/functions_structure.php");			//fonctions pour structurer l'affichage

//Connexion à la base de données
$flux = connectionDB();

?>
<!DOCTYPE html>
<html lang="fr">
    <head>
		<meta name="keywords" content="esir,CUPGE,rennes">
		<meta name="author" content="Mathis_Le_Mineur, Keyvan_Dahlem">
		
        <meta charset="utf-8">
		
        <title><?php echo $titreSite; ?></title>
		
        <link rel="icon" type="image/jpg" href="../images/bouboule.jpg">
		<link href="styles/all.css?v=1.1" rel="stylesheet">
	</head>
	
    <body>
	
		<?php include("static/header.php"); ?>
        <?php include("static/nav.php"); ?>
		

	<section>

	<?php

			echo "<br>";

			echo "<h1 class='latin-bc'> Bienvenue sur le forum ! </h1>";

			$aff_pokedex = displayArticles($flux,getArticles($flux)); 

	?>


	</section>

	</body>
	
<?php include("static/footer.php"); ?>
</html>