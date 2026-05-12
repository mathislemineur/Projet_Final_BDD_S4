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

?>
<!DOCTYPE html>
<html lang="fr">
    <head>
		<meta name="keywords" content="esir,CUPGE,rennes">
		<meta name="author" content="Mathis_Le_Mineur">
		
        <meta charset="utf-8">
		
        <title>Modification</title>
		
        <link rel="icon" type="image/jpg" href="../images/bouboule.jpg">
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
		<link href="styles/all.css?v=1.1" rel="stylesheet">
	</head>
	
    <body>
	
		<?php include("static/header.php"); ?>
        <?php include("static/nav.php"); ?>

        <section>

            <br>
            <h1 class='latin-bc'> Bienvenue <?php echo $_SESSION['login']; ?> ! Quels pokemons avez vous vus et attrapé aujourd'hui ? </h1>
            <br>

            <section>
            <?php

            // si on a une erreur dans le lien
            if (isset($_GET['error'])) {

                if ($_GET['error'] == 'tricheur') {

                    echo '<div class="alert alert-danger">Vous ne pouvez pas avoir attrapé plus de Pokémons que vous n\'en avez vu !</div>';
                
                } elseif ($_GET['error'] == 'infos_manquantes') {

                    echo '<div class="alert alert-warning">Il nous manque des infos !</div>';
                }
            }
            ?>
        </section>

        </section>

        

        <section> 
        <?php

        echo '<form action="php/modification.php" method="POST">';

        // liste des pokemon a selectionner
        displaySelectionPoke(getPoke($flux)); 
        
        echo '<br>';
        echo '<br>';
        echo '<label>Nombre de vues :</label>';
        echo '<input type="number" name="nb_vue" min="0" required>';
        echo '<br>';
        echo '<br>';

        echo '<label>Nombre attrapés :</label>';
        echo '<input type="number" name="nb_attrape" min="0" required>';
        echo '<br>';
        echo '<br>';

        echo '<button type="submit">Mettre à jour</button>';
        echo '</form>';

        ?>
        </section>
        <br>
        <br>
    </body>
    <?php include("static/footer.php"); ?>
</html>