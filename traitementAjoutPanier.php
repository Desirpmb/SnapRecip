<?php
session_start();
include_once('connexionBDD.php');

//recupérer ID, quantite souhaitée du Plat
$id = $_POST["ID"];
$qtDemande = $_POST["Quantite"];
$emailUser = $_SESSION['email'];
echo $id."<br/>";
echo $qtDemande."<br/>";
echo $emailUser."<br/>";

//récupérer les données de la table plat
$queryRecup = "SELECT * FROM Plat WHERE Id=$id";
$result = mysqli_query($mysqli,$queryRecup);
while ($ligne = $result->fetch_assoc())
{
$qtPlat = $ligne['quantiteDispo'];
$nomPlat = $ligne['nomPlat'];
}
echo $qtPlat."<br/>";

//Récupérer données pour savoir s'il existe déjà un panier pour Utilisateur
$queryPan = "SELECT * FROM Panier WHERE email_Utilisateur='$emailUser'";
$resultPan = mysqli_query($mysqli,$queryPan);
$emailExist= mysqli_num_rows($resultPan);
//Si UserEmail n'existe pas ajouter un panier
if($emailExist==0)
{
  $queryAjoutPan = "INSERT INTO Panier(email_Utilisateur) VALUES ('$emailUser')";
  $resultAjoutPan = mysqli_query($mysqli,$queryAjoutPan);
}

//Récuperer le numéro panier appartenant à l'Utilisateur
$queryNPan = "SELECT * FROM Panier WHERE email_Utilisateur='$emailUser'";
$resultNPan = mysqli_query($mysqli,$queryNPan);
while($num = mysqli_fetch_assoc($resultNPan))
{
  $numPanier = $num['id'];
}
echo $numPanier."<br/>";


//tester quantité demandée pas égale à 0
if ($qtDemande != 0)
{
  //tester quantité stock supérieur ou égale à quantité demandée
  if ($qtPlat >= $qtDemande)
  {
    echo "Quantité plat supérieur à quantité demandée !</br>";
  }

  else
  {
    echo "<p class='message' id ='message' style='color:red'> Il ne reste que ".$qtPlat." ".$nomPlat." ! </p>";
  }
}
else
{
  echo "<p class='message' id ='message' style='color:red'> La quatité ne doit pas être 0 ! </p>";
}

$mysqli->close();
//enlever la quantite disponible
//inserer dans ligne commeande le Plat
//soustrait la quantite que l'on souhaite ajouter à la quantiteDisponible
//PrixTotal du panier, additionner tous les produit présent dans la table ligneCommande
//presentation du oanier sous forme de tableau
?>
