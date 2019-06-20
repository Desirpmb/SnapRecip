<?php
//données pour la connexion à la BdD
$host = "localhost";
$user="root";
$password="Dez05377398091";
$database = "SnapRecip";

//connexion à la BdD
$mysqli = mysqli_connect($host, $user, $password, $database);
if (mysqli_connect_errno($mysqli))
{
    echo "Echec lors de la connexion à Mysql : " . $mysqli_connect_error();
}


