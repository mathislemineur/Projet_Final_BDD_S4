<?php

#connexion à la base de données en MySQLi (base de données SQL)
function connectionDB()
{
	//connexion à la BDD via le mode procédural (connexion non persistente)
	
	//gestion des erreurs manuelle (si rapport d'erreur désactivé)

	//modification du jeu de résutlats en utf8

	//retour du flux de connexion

	$res = mysqli_connect(SERVEUR, USER, PWD, DB_NAME);

	if(mysqli_connect_errno()){
		echo "Echec de la connexion à la base de données : " . mysqli_connect_error();
	}

	mysqli_set_charset($res, "utf8");

	return $res;

}

#ferme la connexion à la base de données
function closeDB($mysqli)
{
	mysqli_close($mysqli);

}

#lecture de la base de données en fonction d'une requête SQL passée en paramètre d'entrée
#retourne un tableau associatif contenant les résultats de la requête
#à utiliser pour les requêtes de type SELECT
function readDB($mysqli, $sql_input)
{
	//exécution de la requête $sql_input et récupération du résultat de type mysqli_result
	$query_output = mysqli_query($mysqli, $sql_input);

	//vérification de la requête : 
		//si la requête est incorrect ou le nombre de ligne retourné égal à 0,
		//on retourne un tableau vide

	//Sinon, on retourne un tableau associatif

	if(!$query_output || mysqli_num_rows($query_output) == 0){
		return array();
	}

	return $query_output->fetch_all(MYSQLI_ASSOC);

}

#ecrit/modifie la base de données grâce à la requête SQL passée en paramètre d'entrée
#à utiliser pour les requêtes de type INSERT INTO, UPDATE, DELETE
function writeDB($mysqli, $sql_input)
{
	//exécution de la requête $sql_input
	$query_output = mysqli_query($mysqli, $sql_input);

	//retourne le résultat de la requête

	return $query_output;

}

?>