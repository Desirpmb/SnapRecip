<?php
session_start();
include_once('connexionBDD.php');
//$query = "DELETE FROM Plat WHERE Id=$idPlatSupp";
//$result = mysqli_query($mysqli,$query);

//recupérer ID, quantite souhaitée du Plat
$id = $_POST["ID"];
$Quantite = $_POST["Quantite"];
echo $id."<br/>";
echo $Quantite."<br/>";

//teste de quantite quantiteDIspo
//inserer dans ligne commeande le Plat
//soustrait la quantite que l'on souhaite ajouter à la quantiteDisponible
//PrixTotal du panier, additionner tous les produit présent dans la table ligneCommande
//presentation du oanier sous forme de tableau
?>
