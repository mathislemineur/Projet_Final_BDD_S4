<?php

function displayPokedex($mysqli, $pokedex) {

    // balise pour le css
    $res = '<div class="grille-pokedex">';

    // parcourt du tableau contenant les pokemons
    foreach ($pokedex as $pokemon) {
        
        // balise pour le css des cartes pour chaque pokemon
        $res = $res . '<div class="carte-pokemon-avec-image">';

        // + un lien vers la page du pokemon en utilisant son id
        $res = $res . '<a href="pokemon.php?id=' . $pokemon['id_pokemon'] . '" class="img-pokemon-carte">';
        
        // + l'image en utilisant le chemin
        $res = $res . '<img src="' . $pokemon['chemin'] . '" alt="Image de ' . $pokemon['nom'] . '">';
        
        // balise fermant le lien
        $res = $res . '</a>';

        // + le nom
        $res = $res . '<h3 class="nom">' . $pokemon['nom'] . '</h3>';
        
        // + le numero avec le # pour faire joliiii
        $res = $res . '<p class="num">#' . $pokemon['numero'] . '</p>';

        $res = $res . '<div class="info-type-carte">';

        $types = getTypes($mysqli, $pokemon['id_pokemon']);

        foreach ($types as $type) {
            $res = $res . '<img src="' . $type['chemin'] . '" alt="' . $type['libelle'] . '" class="img-type-carte">';
        }

        // balise fermant
        $res = $res . '</div>';

        // balise fermant le div des cartes
        $res = $res . '</div>';
    }

    // balise fermant le div de la grille
    $res = $res . '</div>';

    // comme le print en python
    echo $res;
}

function displayPokedexPersonnel($mysqli, $pokedex, $captures) {

    // tableau des id des pokemons captures
    $id_captures = array_column($captures, 'id_pokemon'); // on prend juste les id des captures
    
    // balise pour le css
    $res = '<div class="grille-pokedex">';

    // parcourt du tableau contenant les pokemons
    foreach ($pokedex as $pokemon) {

        // si le pokemon a deja ete capture
        if (in_array($pokemon['id_pokemon'], $id_captures)) { // carte normale
            
            // balise pour le css des cartes pour chaque pokemon
            $res = $res . '<div class="carte-pokemon-attrape">';

            // + un lien vers la page du pokemon en utilisant son id
            $res = $res . '<a href="pokemon.php?id=' . $pokemon['id_pokemon'] . '">';
            
            // + l'image en utilisant le chemin
            $res = $res . '<img class="img-pokemon" src="' . $pokemon['chemin'] . '" alt="Image de ' . $pokemon['nom'] . '">';
            
            // balise fermant le lien
            $res = $res . '</a>';

            // + le nom
            $res = $res . '<h3 class="nom">' . $pokemon['nom'] . '</h3>';
    
            // + le numero avec le # pour faire joliiii
            $res = $res . '<p class="num">#' . $pokemon['numero'] . '</p>';

            $res = $res . '<div class="info-type-carte">';

            $types = getTypes($mysqli, $pokemon['id_pokemon']);

            foreach ($types as $type) {
                $res = $res . '<img src="' . $type['chemin'] . '" alt="' . $type['libelle'] . '" class="img-type-carte">';
            }

            $index = array_search($pokemon['id_pokemon'], $id_captures);

            // + le nombre de vues
            $nb_vues = $captures[$index]['nbVue'];
            $res = $res . '<p>Vues : ' . $nb_vues . '</p>';

            // div pour les captures + image de pokeball
            //$res = $res . '<div class="duo-captures-pokeball">';

            // + le nombre de captures
            $nb_captures = $captures[$index]['nbAttrape'];
            $res = $res . '<p>Captures : ' . $nb_captures . '</p>';

            // + l'image de pokeball si capture
            if ($nb_captures > 0) {
                $res = $res . '<img class="img-pokeball" src="images/pokeball.png" alt="Image de pokeball">';
            }

            // balise fermant le div des captures + pokeball
            $res = $res . '</div>';

            // balise fermant le div des cartes
            $res = $res . '</div>';

        } else { // carte des pokemon pas attrapes

            // balise pour le css des cartes pour chaque pokemon
            $res = $res . '<div class="carte-pokemon-pa">';

            // + l'image en utilisant le chemin
            $res = $res . '<img src="' . $pokemon['chemin'] . '" alt="Image de ' . $pokemon['nom'] . '">';

            // + le nom
            $res = $res . '<h3 class="nom"> ??? </h3>';
            
            // + le numero avec le # pour faire joliiii
            $res = $res . '<p class="num">#' . $pokemon['numero'] . '</p>';

            // balise fermant le div des cartes
            $res = $res . '</div>';
        }
    }

    // balise fermant le div de la grille
    $res = $res . '</div>';

    // comme le print en python
    echo $res;
}

function displayCarte($pokedex) {

    // parcourt du tableau contenant les pokemons
    $pokemon = $pokedex[0];
        
    // balise pour le css des cartes pour chaque pokemon
    $res = $res . '<div class="carte-pokemon">';
    
    // + l'image en utilisant le chemin
    $res = $res . '<img src="' . $pokemon['chemin'] . '" alt="Image de ' . $pokemon['nom'] . '">';

    // + le nom
    $res = $res . '<h3 class="nom">' . $pokemon['nom'] . '</h3>';
      
    // + le numero avec le # pour faire joliiii
    $res = $res . '<p class="num">#' . $pokemon['numero'] . '</p>';

    // balise fermant le div des cartes
    $res = $res . '</div>';

    // comme le print en python
    echo $res;
}

function displayCarteEvo($pokedex) {

    // parcourt du tableau contenant les pokemons
    foreach ($pokedex as $pokemon) {
        
        // balise pour le css des cartes pour chaque pokemon
        $res = $res . '<div class="carte-pokemon">';

        // + un lien vers la page du pokemon en utilisant son id
        $res = $res . '<a href="pokemon.php?id=' . $pokemon['numero'] . '">';
        
        // + l'image en utilisant le chemin
        $res = $res . '<img src="' . $pokemon['chemin'] . '" alt="Image de ' . $pokemon['nom'] . '">';

        // balise fermant le lien
        $res = $res . '</a>';

        // + le nom
        $res = $res . '<h3 class="nom">' . $pokemon['nom'] . '</h3>';
        
        // + le numero avec le # pour faire joliiii
        $res = $res . '<p class="num">#' . $pokemon['numero'] . '</p>';

        // balise fermant le div des cartes
        $res = $res . '</div>';

    }

    // comme le print en python
    echo $res;
}

function displayCarteBase($pokedex) {

    // parcourt du tableau contenant les pokemons
    $pokemon = $pokedex[0];
        
    // balise pour le css des cartes pour chaque pokemon
    $res = $res . '<div class="carte-pokemon">';

    // + un lien vers la page du pokemon en utilisant son id
    $res = $res . '<a href="pokemon.php?id=' . $pokemon['numero'] . '">';
    
    // + l'image en utilisant le chemin
    $res = $res . '<img src="' . $pokemon['chemin'] . '" alt="Image de ' . $pokemon['nom'] . '">';

    // balise fermant le lien
    $res = $res . '</a>';

    // + le nom
    $res = $res . '<h3 class="nom">' . $pokemon['nom'] . '</h3>';
      
    // + le numero avec le # pour faire joliiii
    $res = $res . '<p class="num">#' . $pokemon['numero'] . '</p>';

    // balise fermant le div des cartes
    $res = $res . '</div>';

    // comme le print en python
    echo $res;
}

function displayCarteCapture($pokedex) {

    // balise pour le css
    $res = '<div class="grille-pokedex">';

    // parcourt du tableau contenant les pokemons
    $pokemon = $pokedex[0];
        
    // balise pour le css des cartes pour chaque pokemon
    $res = $res . '<div class="carte-pokemon">';

    // + un lien vers la page du pokemon en utilisant son id
    $res = $res . '<a href="pokemon.php?id=' . $pokemon['numero'] . '">';
    
    // + l'image en utilisant le chemin
    $res = $res . '<img src="' . $pokemon['chemin'] . '" alt="Image de ' . $pokemon['nom'] . '">';

    // balise fermant le lien
    $res = $res . '</a>';

    // + le nom
    $res = $res . '<h3 class="nom">' . $pokemon['nom'] . '</h3>';
      
    // + le numero avec le # pour faire joliiii
    $res = $res . '<p class="num">#' . $pokemon['numero'] . '</p>';

    // balise fermant le div des cartes
    $res = $res . '</div>';

    // balise fermant le div de la grille
    $res = $res . '</div>';

    // comme le print en python
    echo $res;
}

function displayInfos($pokedex, $types) {

    // parcourt du tableau contenant les pokemons
    $pokemon = $pokedex[0];
        
    // balise pour le css des cartes pour chaque pokemon
    $res = $res . '<div class="latin">';
   
    // + le nom
    $res = $res . '<h3 class="nom">' . $pokemon['nom'] . '</h3>';
      
    // + le numero avec le # pour faire joliiii
    $res = $res . '<p class="num"> numero : #' . $pokemon['numero'] . ' du pokedex </p>';

    // + la description
    $res = $res . '<p> ' . $pokemon['description'] . '</p>';

    // basilse css pour taille + poids + type
    $res = $res . '<div class="info-case">';

    // colonne de gauche (taille et poids)
    $res = $res . '<div class="info-poids-taille">';

    // + la taille
    $res = $res . '<p> taille : ' . $pokemon['taille'] . ' m </p>';

    // + le poids
    $res = $res . '<p> poids : ' . $pokemon['poids'] . ' kg </p>';

    // balise fermant la colonne de gauche
    $res = $res . '</div>';

    // colonne de droite (types)
    $res = $res . '<div class="info-type">';

    foreach ($types as $type) {
                $res = $res . '<img src="' . $type['chemin'] . '" alt="' . $type['libelle'] . '" class="img-type">';
            }

    // balise fermant la colonne de droite
    $res = $res . '</div>';

    // balise fermant le div de la case
    $res = $res . '</div>';

    // balise fermant le div de latin
    $res = $res . '</div>';

    // comme le print en python
    echo $res;
}

function displayTypes($pokedex) {

    // balise pour le css
    $res = '<div class="grille-pokedex">';
     
    // + les types
    foreach ($pokedex as $pokemon) {

        // balise pour le css des cartes pour chaque pokemon
        $res = $res . '<div class="carte-type">';

        // + les types
        // $res = $res . '<p>' . htmlspecialchars($pokemon['libelle']) . '</p>';

        // + l'image en utilisant le chemin
        $res = $res . '<img src="' . $pokemon['chemin'] . '" alt="Image de ' . $pokemon['libelle'] . '">';

        // balise fermant le div des cartes
        $res = $res . '</div>';
    }

    // balise fermant le div de la grille
    $res = $res . '</div>';

    // comme le print en python
    echo $res;
}

function displayImages($pokedex) {

    $nom_images = ["Image de base", "Image sugimori", "Image sugimori shiny", "Gif miniature" ];
    $ind_nom_image = 0;

    // balise pour le css
    $res = '<div class="grille-pokedex">';
 
    // + les types
    foreach ($pokedex as $pokemon) {

        // balise pour le css des cartes pour chaque pokemon
        $res = $res . '<div class="carte-pokemon">';

        // + l'image en utilisant le chemin
        $res = $res . '<img src="' . $pokemon['chemin'] . '" alt="Image de ' . $pokemon['nom'] . '">';

        // + le nom de l'image
        $res = $res . '<p>' . $nom_images[$ind_nom_image] . '</p>';
        $ind_nom_image++;

        // balise fermant le div des cartes
         $res = $res . '</div>';
    
    }

    // balise fermant le div de la grille
    $res = $res . '</div>';

    // comme le print en python
    echo $res;
    
}

function displayCapa($pokedex) {

    // balise pour le css
    $res = '<div class="grille-pokedex">';

    // + les attaques
    foreach ($pokedex as $pokemon) {

        // balise pour le css des cartes pour chaque pokemon
        $res = $res . '<div class="carte-capa">';

        // + le nom de l'attaque
        $res = $res . '<p>' . $pokemon['libelle_capacite'] . '</p>';

        $res = $res . '<br>';
        // + les statistiques de l'attaque
        $res = $res . '<p>PP : ' . $pokemon['pp_capacite'] . '</p>';

        if (!empty($pokemon['puissance_capacite'])) { // si ca vaut NULL

            $res = $res . '<p>Puissance : ' . $pokemon['puissance_capacite'] . '</p>';

        } else {

            $res = $res . '<p>Puissance : nulle </p>';
        }

        $res = $res . '<p>Précision: ' . $pokemon['precision_capacite'] . '</p>';

        // + le type de l'attaque
        // $res = $res . '<p>Type : ' . $pokemon['type_capacite'] . '</p>';

        $res = $res . '<br>';

        // + l'image du type
        $res = $res . '<img src="' . $pokemon['chemin'] . '" alt="Image de ' . $pokemon['type_capacite'] . '">';

        // balise fermant le div des cartes
        $res = $res . '</div>';
    }

    // balise fermant le div de la grille
    $res = $res . '</div>';

    // comme le print en python
    echo $res;
    
}

function displayEvo($pokedex) {

    // + les types
    foreach ($pokedex as $pokemon) {

        // balise pour le css des cartes pour chaque pokemon
        $res = $res . '<div class="carte-pokemon">';

        // + nom de l'evolution

        $res = $res . '<p>' . $pokemon['nom_evolue'] . '</p>';

        // + id de l'evolution
        $res = $res . '<p> id de l\'évolution: ' . $pokemon['id_evolue'] . '</p>';

        // + le niveau d'evolution
        if ($pokemon['niveau'] == -1) { // niveau d'évolution d'une pierre

            $res = $res . '<p> Moyen d\'évolution: Pierre </p>';

        }else if ($pokemon['niveau'] == -2) { // niveau d'évolution d'un échange

            $res = $res . '<p> Moyen d\'évolution: Échange </p>';

        } else {

            $res = $res . '<p> Niveau d\'évolution: ' . $pokemon['niveau'] . ' </p>';
        }
        

        // balise fermant le div des cartes
        $res = $res . '</div>';
    }

    // comme le print en python
    echo $res;
}

function displayBase($pokedex) {

    // + les types
    foreach ($pokedex as $pokemon) {

        // balise pour le css des cartes pour chaque pokemon
        $res = $res . '<div class="carte-pokemon">';

        // + nom de l'evolution

        $res = $res . '<p>' . $pokemon['nom_base'] . '</p>';

        // + id de l'evolution
        $res = $res . '<p> id de l\'évolution: ' . $pokemon['id_base'] . '</p>';

        // + le niveau d'evolution
        if ($pokemon['niveau'] == -1) { // niveau d'évolution d'une pierre

            $res = $res . '<p> Moyen d\'évolution: Pierre </p>';

        }else if ($pokemon['niveau'] == -2) { // niveau d'évolution d'un échange

            $res = $res . '<p> Moyen d\'évolution: Échange </p>';
            
        } else {

            $res = $res . '<p> Niveau d\'évolution: ' . $pokemon['niveau'] . ' </p>';
        }

        // balise fermant le div des cartes
        $res = $res . '</div>';
    }

    // comme le print en python
    echo $res;
}

function displayCaptures($pokedex) {

    // + les types
    foreach ($pokedex as $pokemon) {

        // balise pour le css des cartes pour chaque pokemon
        $res = $res . '<div class="carte-pokemon">';

        // + nom de l'evolution

        $res = $res . '<p>' . $pokemon['id_pokemon'] . '</p>';

        $res = $res . '</div>';
    }

    // comme le print en python
    echo $res;
}

function displaySelectionPoke($pokedex) {

    echo '<label for="choix_poke"> Choisir un Pokémon </label>';
    echo '<select name="id_pokemon" id="choix_poke" required>';
    echo '<option value=""> ** Sélectionnez un Pokémon ** </option>';

    // parcourt du tableau associatif
    foreach ($pokedex as $pokemon) {

        echo '<option value="' . $pokemon['id_pokemon'] . '">' . $pokemon['nom'] . '</option>';
    }

    echo '</select>';
}

// partie projet

// tous les articles des redacteurs
function displayArticles($mysqli, $bdd) {

    // balise pour le css
    $res = '<div class="grille-pokedex">';

    // parcourt du tableau contenant les pokemons
    foreach ($bdd as $articles) {
        
        // balise pour le css des cartes pour chaque article
        $res = $res . '<div class="carte-article-avec-image">';

        // + le lien
        $res = $res . '<a href="article.php?id=' . $articles['id_article'] . '">';

        // + le nom du jeu
        $res = $res . '<p class="nom-jeu">' . $articles['nom_jeu'] . '</p>';

        // balise fermant le lien
        $res = $res . '</a>';

        // + le titre
        $res = $res . '<h3 class="titre">' . $articles['titre'] . '</h3>';

        // + la date de création
        $res = $res . '<p class="date"> Date de création : ' . $articles['date_de_creation'] . '</p>';

        // balise fermant le div des cartes
        $res = $res . '</div>';
    }

    // balise fermant le div de la grille
    $res = $res . '</div>';

    // comme le print en python
    echo $res;
}

function displayArticlesInfos($bdd) {

    // parcourt du tableau contenant les pokemons
    $infos = $bdd[0];
        
    // balise pour le css 
    $res = $res . '<div class="article-infos">';
      
    // + le titre
    $res = $res . '<h3 class="article-titre">' . $infos['titre'] . '</h3>';

    // + nom du jeu
    $res = $res . '<p class="jeu-nom">' . $infos['nom_du_jeu'] . '</p>';

    // + le contenu (critique du redacteur)
    $res = $res . '<p> ' . $infos['contenu'] . '</p>';

    // + le prix
    $res = $res . '<p> Prix : ' . $infos['prix'] . ' $</p>';

    // + le synopsis
     $res = $res . '<p> ' . $infos['synopsis'] . '</p>';

    // + le support

    // + categorie

    // + la note
    $res = $res . '<p> Note du redacteur : ' . $infos['note'] . '</p>';

    // + la note moyenne

    // + le pseudo du redacteur
    $res = $res . '<p> Rédacteur : ' . $infos['pseudo_redacteur'] . '</p>';

    // basilse css pour les deux dates
    $res = $res . '<div class="article-date">';

    // les deux dates
    // date de creation
    $res = $res . '<p> Date de création : ' . $infos['date_de_creation'] . '</p>';
    
    // date de modif
    $res = $res . '<p> Date de modification : ' . $infos['date_de_modification'] . '</p>';

    // balise fermant le div des dates
    $res = $res . '</div>';

    // balise fermant le div du debut
    $res = $res . '</div>';

    // comme le print en python
    echo $res;
}

function displayInfosAvis($bdd) {

    // parcourt du tableau contenant les pokemons
    $avis = $bdd[0];

    // balise pour le css 
    $res = $res . '<div class="avis-infos">';
      
    // + le titre
    $res = $res . '<h3 class="article-titre">' . $avis['titre'] . '</h3>';

    // + nom du jeu
    $res = $res . '<p class="jeu-nom">' . $avis['nom_jeu'] . '</p>';

    // + le contenu
    $res = $res . '<p> ' . $avis['contenu'] . '</p>';

    // + la note
    $res = $res . '<p> Note : ' . $avis['note'] . '</p>';

    // + le pseudo du redacteur
    $res = $res . '<p> Avis de : ' . $avis['pseudo'] . '</p>';

    // date de creation
    $res = $res . '<p> ' . $avis['date_de_creation'] . '</p>';

    // balise fermant le div du debut
    $res = $res . '</div>';

    // comme le print en python
    echo $res;
}

function displayInfosUser($bdd) {

    // parcourt du tableau contenant les pokemons
    $infos = $bdd[0];

    // balise pour le css 
    $res = $res . '<div class="user-infos">';
      
    // + le pseudo
    $res = $res . '<p> Bienvenue ' . $infos['username'] . '</p>';

    // + le nom
    $res = $res . '<p> Nom : ' . $infos['nom'] . '</p>';
    
    // + le prenom
    $res = $res . '<p> Prénom : ' . $infos['prenom'] . '</p>';
    
    // + le mail
    $res = $res . '<p> Mail : ' . $infos['mail'] . '</p>';
    
    // + la date de naissance
    $res = $res . '<p> Date de naissance : ' . $infos['date_de_naissance'] . '</p>';
    
    // + l'age

    // + la photo de profil

    // date de creation
    $res = $res . '<p> Date de création du compte : ' . $infos['date_de_creation'] . '</p>';
    
    // date de derniere connexion
    $res = $res . '<p> Date de dernière connexion : ' . $infos['date_derniere_connexion'] . '</p>';

    // + le role
    $res = $res . '<p> Rôle : ' . $infos['role'] . '</p>';
    
    // balise fermant le div du debut
    $res = $res . '</div>';

    // comme le print en python
    echo $res;
}
?>