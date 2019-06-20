<!DOCTYPE html>
<html>
    <head>
      <meta charset="UTF-8" />
      <meta name="author" content="Steffie" />
    </head>
    <body>
<?php
include_once('connexionBDD.php');
//On récupère les données du formulaire
if (!empty($_POST["nomClient"] && $_POST["prenomClient"] && $_POST["sexe"] && $_POST["emailClient"] && $_POST["naissance"] && $_POST["motdepasse"])) 
{
      $nom = $_POST["nomClient"];
      $prenom = $_POST["prenomClient"];
      $sexe = $_POST["sexe"];
      $email = $_POST["emailClient"];
      $DateNaissance = $_POST["naissance"];
      $MotDePasse =$_POST["motdepasse"];

//La requête est envoyée sur mysql
      $result = mysqli_query($mysqli, "INSERT INTO Utilisateur (Nom, Prenom, Sexe, DateNaissance, Email, MotDePasse) 
          VALUES ( '$nom', '$prenom', '$sexe', '$DateNaissance', '$email', '$MotDePasse')");
      echo "envoie de la requête effectué";
      if (!$result) {
          echo "<p>Désolée, requête impossible ! </p>";
      }
      else {
                   
          echo "<p> Vous êtes le client numéro </p>";
          $query = "SELECT * FROM Utilisateur where Email='$email';";
          $result1 = mysqli_query($mysqli,$query);
          $resultCheck= mysqli_num_rows($result1);

          if($resultCheck > 0){
            while($ligne = mysqli_fetch_assoc($result1)){
              echo $ligne['Prenom'];
            }
          }

      }

      $mysqli->close();
}else {
   echo "<p>Impossible de créer un compte sans votre nom et votre email </p>";
}
?>
    </body>
</html>
