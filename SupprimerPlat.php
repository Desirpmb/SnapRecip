<?php
session_start();
include_once('connexionBDD.php');
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Snap Recip</title>
  <link rel="stylesheet" href="./css/style.css"/>
  <link rel="stylesheet" href="css/recettes.css"/>
  <link href="https://fonts.googleapis.com/css?family=Great+Vibes&display=swap" rel="stylesheet">
</head>
<body>
  <div id="principale">
    <?php include("menu.php"); ?>
    <div class="accueil-img">
      <h1>Snap Recip</h1>
      <h2>Le chef, c'est vous !</h2>
    </div>
  </div>
  <div id="boutons">
    <a href="home.php"><input class="bouton" type="button" value="Revenir en arrière"> </a>
  </div>
  <?php
    //recuperer données recettes
  $sql = "SELECT * FROM Plat" ;
  $resultat = $mysqli->query($sql);


  echo "<div id='conteneur'>";
  while ($ligne = $resultat->fetch_assoc()) {
    echo  "<div class='recette'>
    <img class='illustration' src='Images/" . $ligne['urlImage']."' >
    <div class='nom'>" . $ligne['nomPlat'] ."</div>
    <div class='description'>" . $ligne['description'] ."</div>
    <div id='ajout' ><input class='bouton' type='submit' value='Supprimer le plat' ></div>
    </div>";
  }
  echo "</div>";

  $mysqli->close();
  ?>
</body>
<footer>
  <a href="#"><input class="bouton" id="raccourci" type="button" value="Vers le haut"></a>
</footer>
</html>