<?php
$erreur = " ";
$success = " ";
include_once 'connexionBDD.php';

echo "$include </br>";

    //Récupérer les données
    $nomPlat = htmlspecialchars($_POST["nomPlat"]);
    $urlImage = htmlspecialchars($_POST["urlImage"]);
    $description = $_POST["description"];
    $quantiteDispo = $_POST["quantiteDispo"];
    $prixUnitaire = $_POST["prixUnitaire"];
    $id = '\N'; /* auto-increment */

echo "<p> $nomPlat <p/>";

    //verification du nombre de caractère saisie
    if (!empty($_POST["nomPlat"] && $_POST["urlImage"] && $_POST["description"] && $_POST["quantiteDispo"] && $_POST["prixUnitaire"]))
    {
          echo "Vérification empty ok <br/>";
          //verification du nombre de caractère saisie
          $nomPlatLength=strlen($nomPlat);
          if($nomPlatLength <=150)
          {
              $urlImageLength=strlen($urlImage);
              if($urlImageLength<=150)
              {
                  $descriptionLength=strlen($description);
                  if($descriptionLength<=250)

                  {
                      echo "<p> vérification longeur OK ! </p>" ;

                      $sql = "INSERT INTO Plat(Id, nomPlat, urlImage, description, quantiteDispo, prixUnitaire)
                                        VALUES ('$id','$nomPlat','$urlImage','$description', '$quantiteDispo', '$prixUnitaire')";

                      $result = mysqli_query($mysqli,$sql);

                      echo "$r&esult</p>" ;

                      if (!$result)
                      {
                          echo "<p>Désolée, requête impossible ! </p>";
                      }
                      else
                      {
                          echo"<p> requête OK ! </p>";

                          $success ='<p style="text-align:center; color:green"> Votre plat'.$nomPlat['nomPlat'].' a été bien ajouté !</p>';
                      }
                      $mysqli->close();
                  }
                  else
                  {
                      $erreur='<p style="text-align:center; color:red">Votre description dépasse 250 caractères!<p>';
                  }

              }
              else
              {
                  $erreur='<p style="text-align:center; color:red">Votre urlImage dépasse 150 caractères!<p>';
              }

          }
          else
          {
              $erreur='<p style="text-align:center; color:red">Le nom du plat dépasse 150 caractères !<p>';
          }
    }
    else
    {
         $erreur='<p style="text-align:center; color:red">L\'un des champs n\'a pas été complété !<p>';
    }

    if (isset($erreur)){ echo $erreur; }
    if (isset($success)) { echo $success; }
?>
