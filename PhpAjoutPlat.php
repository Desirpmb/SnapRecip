<?php
include_once('connexionBDD.php');

$id = '\N'; /* auto-increment */
$nomPlat = htmlspecialchars($_POST["nomPlat"]);
$urlImage = htmlspecialchars($_POST["urlImage"]);
$description = htmlspecialchars($_POST["description"]);
$quantiteDispo = $_POST["quantiteDispo"];
$prixUnitaire = $_POST["prixUnitaire"];

$sql = "INSERT INTO Plat(Id, nomPlat, urlImage, description, quantiteDispo, prixUnitaire)
                  VALUES ('$id', '$nomPlat', '$urlImage','$description', '$quantiteDispo', '$prixUnitaire')";
$result = $mysqli->query ($sql) ;

          if($result)
          {
              echo "<p> requête OK ! </p>";

          }
          else
          {
              echo "<p>Désolée, requête impossible ! </p>";
          }

$mysqli->close();

?>
