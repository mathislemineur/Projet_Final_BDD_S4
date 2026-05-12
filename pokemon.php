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
$id_poke = $_GET['id'];

// si ca exuste pas demi tour ou si c'est vide demi tour
if (isset($id_poke) == false || $id_poke == "") {
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
        // on recup le nom  et le numero du pokemon pour le mettre dans le titre de la page
        $nom_poke = getInfos($flux, $id_poke)[0]['nom'];
        $num_poke = getInfos($flux, $id_poke)[0]['numero'];
        echo "<title>" . $num_poke . " - " . $nom_poke  . "</title>";
        ?>
		
        <title>IDKS</title>
		
        <link rel="icon" type="image/jpg" href="images/bouboule.jpg">
		<link href="styles/all.css?v=1.1" rel="stylesheet">
	</head>
	
    <body>
	
		<?php include("static/header.php"); ?>
        <?php include("static/nav.php"); ?>
        <?php include("static/nav_dex.php"); ?>

        <section>
	
		<?php

            echo "<br>";

            // balise pour le css
            echo '<div class="grille-pokedex">';

            $aff_carte = displayCarte(getPokedex2($flux, $id_poke));

            $infos = getInfos($flux, $id_poke);
            $types = getTypes($flux, $id_poke);

            $aff_infos = displayInfos($infos, $types);

            // balise fermant le div de la grille
            echo '</div>';

            // toutes les images
            echo "<h2 class='latin-bc'> Toutes les images : </h2>";

            $aff_img = displayImages(getImages($flux, $id_poke));

            // attaques attribuees
            echo "<h2 class='latin-bc'> Toutes les attaques : </h2>";

            $aff_capa = displayCapa(getCapa($flux, $id_poke));

        //     // premiere evo
        //     $evos1 = getEvo($flux, $id_poke);
        //     $id_evo1 = getEvo($flux, $id_poke)[0]['id_evolue'];

        //     if (!empty($id_evo1)) { // si la premiere evo existe

        //         echo "<h2> Toutes les évolutions : </h2>";

        //         // balise pour le css
        //         echo '<div class="grille-pokedex">';

        //         $aff_evo1 = displayEvo(getEvo($flux, $id_poke));

        //         // seconde evo
        //         $id_evo2 = getEvo($flux, $id_evo1)[0]['id_evolue'];

        //         if (!empty($id_evo2)) { // si la seconde evo existe

        //             $aff_evo2 = displayEvo(getEvo($flux, $id_evo1));

        //             // balise fermant le div de la grille
        //             echo '</div>';

        //         } else { // sinon on affiche juste la premiere evo

        //             // balise fermant le div de la grille
        //             echo '</div>';
        //         }

        //         echo "<h2> Les cartes des évolutions : </h2>";

        //         // balise pour le css
        //         echo '<div class="grille-pokedex">';

        //         foreach ($evos1 as $ev) {
        //             displayCarteEvo(getPokedex2($flux, $ev['id_evolue']));
        //         }

        //         if (!empty($id_evo2)) { // si la seconde evo existe

        //             $aff_carte_evo2 = displayCarteEvo(getPokedex2($flux, $id_evo2));
        //         }
                
        //         // balise fermant le div de la grille
        //         echo '</div>';
            
        //     } else { // sinon on affiche rien pour les evo
        //         echo "<h2> Toutes les évolutions : </h2>";
        //         echo "<p> Ce Pokémon n'évolue pas </p>";
        //     }
        
        // // premiere base
        //     $id_base1 = getBase($flux, $id_poke)[0]['id_base'];

        //     if (!empty($id_base1)) { // si la premiere base existe

        //         echo "<h2> Toutes les bases : </h2>";

        //         // balise pour le css
        //         echo '<div class="grille-pokedex">';

        //         $aff_base1 = displayBase(getBase($flux, $id_poke));

        //         // seconde base
        //         $id_Base2 = getBase($flux, $id_base1)[0]['id_base'];

        //         if (!empty($id_Base2)) { // si la seconde base existe

        //             $aff_base2 = displayBase(getBase($flux, $id_base1));

        //             // balise fermant le div de la grille
        //             echo '</div>';

        //         } else { // sinon on affiche juste la premiere base

        //             // balise fermant le div de la grille
        //             echo '</div>';
        //         }

        //         echo "<h2> Les cartes des bases : </h2>";

        //         // balise pour le css
        //         echo '<div class="grille-pokedex">';

        //         $aff_carte_base1 = displayCarteBase(getPokedex2($flux, $id_base1));

        //         if (!empty($id_Base2)) { // si la seconde base existe

        //             $aff_carte_base2 = displayCarteBase(getPokedex2($flux, $id_Base2));
        //         }
                
        //         // balise fermant le div de la grille
        //         echo '</div>';
            
        //     } else { // sinon on affiche rien pour les base
        //         echo "<h2> Toutes les bases : </h2>";
        //         echo "<p> Ce Pokémon n'a pas de base </p>";
        //     }

            // arbre d'evolution

            echo "<h2 class='latin-bc'> Ligne d'evolution : </h2>";

            $evos1 = getEvo($flux, $id_poke);
            $id_evo1 = getEvo($flux, $id_poke)[0]['id_evolue'];
            $id_base1 = getBase($flux, $id_poke)[0]['id_base'];

            if (!empty($id_base1)) { // si la premiere base existe

                // seconde base
                $id_Base2 = getBase($flux, $id_base1)[0]['id_base'];

                // balise pour le css
                echo '<div class="grille-pokedex">';

                if (!empty($id_Base2)) { // si la seconde base existe

                    // afficchage base 2
                    $aff_carte_base2 = displayCarteBase(getPokedex2($flux, $id_Base2));

                    // afficchage base 1
                    $aff_carte_base1 = displayCarteBase(getPokedex2($flux, $id_base1));

                    // afficchage actuel
                    $aff_carte = displayCarte(getPokedex2($flux, $id_poke));

                    // balise fermant le div de la grille
                    echo '</div>';
                
                } else { // sinon pas de base 2

                    // afficchage base 1
                    $aff_carte_base1 = displayCarteBase(getPokedex2($flux, $id_base1));
                
                    // afficchage actuel
                    $aff_carte = displayCarte(getPokedex2($flux, $id_poke));

                    if (!empty($id_evo1)) { // si evo 1

                        foreach ($evos1 as $ev) {

                            // afficchage evo 1
                            displayCarteEvo(getPokedex2($flux, $ev['id_evolue']));
                        }

                        // balise fermant le div de la grille
                        echo '</div>';

                    } else {

                        // balise fermant le div de la grille
                        echo '</div>';

                    }                    
                }

            } elseif (!empty($id_evo1)) { // sinon pas de base mais une evo

                // evo 2
                $id_evo2 = getEvo($flux, $id_evo1)[0]['id_evolue'];

                // balise pour le css
                echo '<div class="grille-pokedex">';

                // afficchage actuel
                $aff_carte = displayCarte(getPokedex2($flux, $id_poke));

                foreach ($evos1 as $ev) {

                    // afficchage evo 1
                    displayCarteEvo(getPokedex2($flux, $ev['id_evolue']));
                }

                if (!empty($id_evo2)) { // si la seconde evo existe, on rajoute evo 2

                    // afficchage evo 2
                    $aff_carte_evo2 = displayCarteEvo(getPokedex2($flux, $id_evo2));

                    // balise fermant le div de la grille
                    echo '</div>';

                } else { // que actuel et evo 1

                    // balise fermant le div de la grille
                    echo '</div>';

                }
            
            } else { // ni base ni evo

                // balise pour le css
                echo '<div class="grille-pokedex">';

                // afficchage actuel
                $aff_carte = displayCarte(getPokedex2($flux, $id_poke));

                // balise fermant le div de la grille
                echo '</div>';
            }





                







		?>
	</section>

	</body>
	
<?php include("static/footer.php"); ?>
</html>