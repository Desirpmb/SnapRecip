<?php
session_start();
include_once('connexionBDD.php');
$idPlatSupp=$_GET["varID"];
$query = "DELETE FROM Plat WHERE Id=$idPlatSupp";
$result = mysqli_query($mysqli,$query);
header("Refresh: 0;url=SupprimerPlat.php");
?>
