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
		
        <title>Connection</title>
		
        <link rel="icon" type="image/jpg" href="../images/bouboule.jpg">
		<link href="styles/all.css?v=1.1" rel="stylesheet">
	</head>
	
    <body>
	
		<?php include("static/header.php"); ?>
        <?php include("static/nav.php"); ?>

        <section>

            <br>
            <h1 class='latin-bc'> Connectez-vous ! </h1>
            <br>

            <?php

            // si on a une erreur dans le lien
            if (isset($_GET['error'])) {

                if ($_GET['error'] == 'problemmesdindentifiants') { // pas les bons identifiants

                    echo '<div class="alert alert-danger">Identifiant ou mot de passe incorrect !</div>';
                
                } elseif ($_GET['error'] == 'existedeja') { // erreur d'inscription

                    echo '<div class="alert alert-warning">Ce pseudo est déjà pris ! Trouves en un autre</div>';
                }
            }

            if (isset($_GET['signup']) && $_GET['signup'] == 'inscrit') { // inscription réussie

                echo '<div class="alert alert-success">Inscription réussie ! Connectez-vous maintenant.</div>';
            
            }

            ?>

        </section>
        <section>

            <!-- formulaire de co -->
            <!-- POST pour pas que ca se voit dans le lein -->
            <form action="php/login.php" method="POST">

                <!-- classes Bootstrap : ca fonctionne tout seul tkt  -->
                <div class="mb-3">

                    <!-- phrase au dessus de la zone a remplir -->
                    <label for="login" class="form-label">Identifiant (Login) :</label>

                    <!-- zone a remplir pour login | le required rend le formulaire non envoyable si c'est pas rempli -->
                    <input type="text" name="login" id="login" class="form-control" required>
                </div>
                
                <div class="mb-3">

                    <!-- phrase au dessus de la zone a remplir -->
                    <label for="password" class="form-label">Mot de passe :</label>

                    <!-- zone a remplir pour le mdp | le required rend le formulaire non envoyable si c'est pas rempli -->
                    <input type="password" name="password" id="password" class="form-control" required>
                </div>
                
                <!-- bouton pour envoyer le formulaire | le  primary donne la couleur bleu -->
                <button type="submit" class="btn btn-primary"> Shazammmmm </button>
            </form>

        </section>
    </body>
    <?php include("static/footer.php"); ?>
</html>