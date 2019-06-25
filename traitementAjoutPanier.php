<?php
session_start();
include_once('connexionBDD.php');
//$idPlatSupp=$_GET["varID"];
//$query = "DELETE FROM Plat WHERE Id=$idPlatSupp";
//$result = mysqli_query($mysqli,$query);
header("Refresh: 0;url=SupprimerPlat.php");
//recupérer ID, quantiteDIspo Plat
//teste de quantite quantiteDIspo
//inserer dans ligne commeande le Plat
//soustrait la quantite que l'on souhaite ajouter à la quantiteDisponible
//PrixTotal du panier, additionner tous les produit présent dans la table ligneCommande
//presentation du oanier sous forme de tableau
?>
