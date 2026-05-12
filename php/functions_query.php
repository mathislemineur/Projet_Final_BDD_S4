<?php

function getPokedex($mysqli) {

    // on prend l'id, le numero, le nom  chez pokemon et le chemin de l'image chez image avec une jointure entre sur l'id
    $sql = "SELECT p.id_pokemon, p.numero, p.nom, i.chemin 
            FROM pokemon p
            JOIN image i ON p.id_pokemon = i.id_pokemon
            WHERE i.chemin LIKE 'images/pokemon/%'
            ORDER BY p.numero ASC;";

    // tableau associatif
    $res = readDB($mysqli, $sql);

    // on retourne le tableau associatif
    return $res;
}

function getPokedex2($mysqli, $id) {

    // on prend l'id, le numero, le nom  et la description chez pokemon et le chemin de l'image chez image avec une jointure entre sur l'id
    $sql = "SELECT p.id_pokemon, p.numero, p.nom, p.description, i.chemin 
            FROM pokemon p
            JOIN image i ON p.id_pokemon = i.id_pokemon
            WHERE p.id_pokemon = " . $id . " AND i.chemin LIKE 'images/pokemon/%';";

    // tableau associatif
    $res = readDB($mysqli, $sql);

    // on retourne le tableau associatif
    return $res;
}

function getInfos($mysqli, $id) {

    // on prend l'id, le numero, le nom, la description, la taille et le poids chez pokemon, le type chez type avec une jointure entre sur l'id
    $sql = "SELECT p.id_pokemon, p.numero, p.nom, p.description, t.libelle, p.taille, p.poids
            FROM pokemon p
            JOIN esttype et ON p.id_pokemon = et.id_pokemon
            JOIN type t ON et.id_type = t.id_type
            WHERE p.id_pokemon = " . $id . "
            ORDER BY p.numero ASC;";

    // tableau associatif
    $res = readDB($mysqli, $sql);

    // on retourne le tableau associatif
    return $res;
}

function getTypes($mysqli, $id) {

    // on prend le nom du type et le chemin de l'image avec une jointure entre sur l'id
    $sql = "SELECT t.libelle, t.chemin
            FROM pokemon p
            JOIN esttype et ON p.id_pokemon = et.id_pokemon
            JOIN type t ON et.id_type = t.id_type
            WHERE p.id_pokemon = " . $id . "
            ORDER BY p.numero ASC;";

    // tableau associatif
    $res = readDB($mysqli, $sql);

    // on retourne le tableau associatif
    return $res;
}

function getImages($mysqli, $id) {

    // on prend le nom  chez pokemon et le chemin de l'image chez image avec une jointure entre sur l'id
    $sql = "SELECT p.nom, i.chemin
            FROM pokemon p
            JOIN image i ON p.id_pokemon = i.id_pokemon
            WHERE p.id_pokemon = " . $id . "
            ORDER BY p.numero ASC;";

    // tableau associatif
    $res = readDB($mysqli, $sql);

    // on retourne le tableau associatif
    return $res;
}

function getCapa($mysqli, $id) {

    // on prend l'id, le nom  des capacites et le chemin de l'image du type de la capa avec une jointure entre sur l'id
    $sql = "SELECT c.id_capacite, c.libelle_capacite, c.pp_capacite, c.puissance_capacite, c.precision_capacite, c.id_type, t.libelle AS type_capacite, t.chemin
            FROM pokemon p
            JOIN lance l ON p.id_pokemon = l.id_pokemon
            JOIN capacite c ON l.id_capacite = c.id_capacite
            JOIN type t ON c.id_type = t.id_type
            WHERE p.id_pokemon = " . $id . "
            ORDER BY p.numero ASC;";

    // tableau associatif
    $res = readDB($mysqli, $sql);

    // on retourne le tableau associatif
    return $res;
}

function getEvo($mysqli, $id) {

    // on prend l'id de l'evo, le niveau pour evo, le nom de l'evo avec une jointure entre sur l'id
    $sql = "SELECT e.id_pokemon_evolue, e.niveau, p2.nom AS nom_evolue , p2.id_pokemon AS id_evolue
            FROM pokemon p
            JOIN evolue e ON p.id_pokemon = e.id_pokemon_base
            JOIN pokemon p2 ON e.id_pokemon_evolue = p2.id_pokemon
            WHERE p.id_pokemon = " . $id . "
            ORDER BY p.numero ASC;";

    // tableau associatif
    $res = readDB($mysqli, $sql);

    // on retourne le tableau associatif
    return $res;
}

function getBase($mysqli, $id) {

    // on prend l'id de la base, le niveau pour base, le nom de la base avec une jointure entre sur l'id
    $sql = "SELECT e.id_pokemon_base AS id_base , e.niveau , pbase.nom AS nom_base
            FROM pokemon p
            JOIN evolue e ON p.id_pokemon = e.id_pokemon_evolue
            JOIN pokemon pbase ON e.id_pokemon_base = pbase.id_pokemon
            WHERE p.id_pokemon = " . $id . ";";

    // tableau associatif
    $res = readDB($mysqli, $sql);

    // on retourne le tableau associatif
    return $res;
}

// pour les injections sql ici c'est le paradis mais tkt 
function checkLogin($mysqli, $nom, $mdp) {
    
    $sql = "SELECT nom_dresseur, mdp_dresseur, id_dresseur
            FROM dresseur 
            WHERE nom_dresseur = '" . $nom . "' AND mdp_dresseur = '" . $mdp . "';";

    // tableau associatif
    $res = readDB($mysqli, $sql);

    // on retourne le tableau associatif
    return $res;
}

function checkExistance($mysqli, $nom) {

    // on select ce qu'on veut c'est pas giga important faut juste verifier si ca renvoi du vide ou pas
    $sql = "SELECT id_dresseur
            FROM dresseur
            WHERE nom_dresseur = '" . $nom . "';";

    $res = readDB($mysqli, $sql);

    return !empty($res); // true s'il existe et false sinon
}

function insertDresseur($mysqli, $nom, $mdp) {
    
    $sql = "INSERT INTO dresseur (nom_dresseur, mdp_dresseur)
            VALUES ('" . $nom . "', '" . $mdp . "');";

    return writeDB($mysqli, $sql);
}

function NombreVues($mysqli, $id_dresseur) {

    // le nombre de lignes c'est le nombre de captures differentes
    $sql = "SELECT COUNT(DISTINCT(id_pokemon)) AS nb
            FROM pokedex
            WHERE id_dresseur = " . $id_dresseur . " AND nbVue > 0;";

    $res = readDB($mysqli, $sql);

    // on retourne le nombre
    return $res[0]['nb'];
}

function NombreCaptures($mysqli, $id_dresseur) {

    // le nombre de lignes c'est le nombre de captures differentes
    $sql = "SELECT COUNT(DISTINCT(id_pokemon)) AS nb
            FROM pokedex
            WHERE id_dresseur = " . $id_dresseur . " AND nbAttrape > 0;";

    $res = readDB($mysqli, $sql);

    // on retourne le nombre
    return $res[0]['nb'];
}

function getCaptures($mysqli, $id_dresseur) {

    // on prend l'id des pokemons captures
    $sql = "SELECT id_pokemon, nbVue, nbAttrape
            FROM pokedex 
            WHERE id_dresseur = " . intval($id_dresseur) . ";";

    $res = readDB($mysqli, $sql);

    // on retourne le tableau associatif
    return $res;
}

function modifDex($mysqli, $id_dresseur, $id_pokemon, $nbVues, $nbAttrape) {

    // verif si le poke est deja enregistre
    $sql_verif = "SELECT id_pokemon
                  FROM pokedex
                  WHERE id_dresseur = " . intval($id_dresseur) . " AND id_pokemon = " . intval($id_pokemon) . ";";

    $verif = readDB($mysqli, $sql_verif);

    if (!empty($verif)) { // si c'est pas vide, il existe donc on update

        $sql_update = "UPDATE pokedex
                       SET nbVue = " . intval($nbVues) . ", nbAttrape = " . intval($nbAttrape) . " 
                       WHERE id_dresseur = " . intval($id_dresseur) . " AND id_pokemon = " . intval($id_pokemon) . ";";

        return writeDB($mysqli, $sql_update);

    } else { // sinon on insert

        $sql_insert = "INSERT INTO pokedex (id_dresseur, id_pokemon, nbVue, nbAttrape)
                       VALUES (" . intval($id_dresseur) . ", " . intval($id_pokemon) . ", " . intval($nbVues) . ", " . intval($nbAttrape) . ");";

        return writeDB($mysqli, $sql_insert);

    }

}

function getPoke($mysqli) {

    // on prend l'id et le nom chez pokemon
    $sql = "SELECT id_pokemon, nom
            FROM pokemon
            ORDER BY numero ASC;";

    // tableau associatif
    $res = readDB($mysqli, $sql);

    // on retourne le tableau associatif
    return $res;
}
