<?php

session_start();

//Import des fichiers nécessaires
require_once("./includes/config-bdd-pokedex.php");      //config base de données
require_once("./includes/constantes-pokedex.php");      //constantes du site
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
		<meta name="author" content="Mathis_Le_Mineur">
		
        <meta charset="utf-8">
		
        <title><?php echo $titreSite; ?></title>
		
        <link rel="icon" type="image/jpg" href="../images/bouboule.jpg">
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
		<link href="styles/all.css?v=1.1" rel="stylesheet">
	</head>
	
    <body>
	
		<?php include("static/header.php"); ?>
        <?php include("static/nav.php"); ?>
		

	<section>

	<?php

		if (isset($_SESSION['id_dresseur'])) {

			echo "<section>";

			echo "<br>";

			echo "<h1 class='latin-bc'> 1 G : Kanto </h1>";

			echo "</section>";

			echo "<section>";

			echo "<br>";

			echo "<h2 class='latin-bc'> Votre pokedex personnel : </h2>";

			echo "<br>";

			echo "</section>";

			$nb_vues = NombreVues($flux, $_SESSION['id_dresseur']);
			$nb_attrapes = NombreCaptures($flux, $_SESSION['id_dresseur']);
			
			echo "<section>";
			echo "<div class='alert alert-info'>";
			echo "Parmi les pokemon du pokedex de la  1G, vous en avez vus " . $nb_vues . " et attrapé " . $nb_attrapes ." différents . " ;
			echo "</div>";
			echo "</section>";

			$cap = getCaptures($flux, $_SESSION['id_dresseur']);

			displayPokedexPersonnel($flux, getPokedex($flux), $cap);

		} else {

			echo "<br>";

			echo "<h1 class='latin-bc'> 1 G : Kanto </h1>";

			$aff_pokedex = displayPokedex($flux,getPokedex($flux)); 

		}

	?>


	</section>

	</body>
	
<?php include("static/footer.php"); ?>
</html>