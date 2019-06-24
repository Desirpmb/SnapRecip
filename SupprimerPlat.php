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
    //recuperer données plats
  $sql = "SELECT * FROM Plat" ;
  $resultat = $mysqli->query($sql);

  echo "<div id='conteneur'>";
  while ($ligne = $resultat->fetch_assoc())
  {
    echo "<form name='formSup".$ligne['Id']."' action='' method='POST'>";
    echo
    "<div class='recette'>
    <img class='illustration' src='Images/" . $ligne['urlImage']."'>
    <div class='nom'>" . $ligne['nomPlat'] ."</div>
    <div class='description'>" . $ligne['description'] ."</div>
    <div id='ajout' ><input name='".$ligne['Id']."'class='bouton' type='submit' value='Supprimer le plat ".$ligne['Id']."'></div>
    </div>";
    echo "</form>";
    $id = $ligne['Id'];
  }
  echo "</div>";

    //Création d'un tableau ID
  for ($i=0; $i<=$id; $i++)
  {
    $sup = $i;
    //Si utilisateur clique sur bouton ID
    if (isset ($_POST[$sup]))
    {
      echo $sup;
      $query = "SELECT nomPlat FROM Plat WHERE Id=$sup";
      $result = mysqli_query($mysqli,$query);
      if ($result)
      {
        while($ligne = $result->fetch_assoc())
        {
          $nomplat = $ligne ['nomPlat'];
        }
          echo "<div id='boutons'>";
            echo "<form name='Confirmation' action='' method='POST'>";
            echo "<p style='color:red'> Êtes-vous sûr de vouloir supprimer le plat : ".$nomplat." ? </p>
                  <input name='Confirmation' type='submit' value='Confirmer' class='bouton'>";
            echo "</form>";
          echo "</div>";


          if (isset($_POST["Confirmation"]))
          {
            echo "ok";
            $query2 = "DELETE FROM Plat WHERE Id=$sup";
            $result2 = mysqli_query($mysqli,$query2);
            header("Refresh: 0;url=SupprimerPlat.php");
          }
      }
    }
  }

  $mysqli->close();
  ?>
</body>
<footer>
  <a href="#"><input class="bouton" id="raccourci" type="button" value="Vers le haut"></a>
</footer>
</html>
