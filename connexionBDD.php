<?php
//données pour la connexion à la BdD
$host = "localhost";
$user="php";
$password="php";
$database = "SnapRecip";

//connexion à la BdD
$mysqli = mysqli_connect($host, $user, $password, $database);
if (mysqli_connect_errno($mysqli))
{
    echo "Echec lors de la connexion à Mysql : " . $mysqli_connect_error();
}

if (!$mysqli->set_charset("utf8")) {
    echo "Erreur lors du chargement du jeu de caractères utf8 ";
}
