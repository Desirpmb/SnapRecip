<?php
$erreur = " ";
$success = " ";
include_once('connexionBDD.php');
if(isset($_POST['formPlat']))
{
    //Récupérer les données
    if (!empty($_POST["nomPlat"] && $_POST["urlImage"] && $_POST["description"] && $_POST["quantiteDispo"] && $_POST["prixUnitaire"]))
    {
          $nomPlat = $_POST["nomPlat"];
          $urlImage = $_POST["urlImage"];
          $description = $_POST["description"];
          $quantiteDispo = $_POST["quantiteDispo"];
          $prixUnitaire = $_POST["prixUnitaire"];

          //verification du nombre de caractère saisie
          $nomPlatLength=strlen($nomPlat);
          if($nomPlatLength <=150)
          {
              $urlImageLength=strlen($urlImage);
              if($urlImageLength<=150)
              {
                  $descriptionLength=strlen($description);
                  if($descriptionLength<=150)
                  {
                      $query = "INSERT INTO Plat(nomPlat, urlImage, description, quantiteDispo, prixUnitaire) VALUES ('$nomPlat', '$urlImage', '$quantiteDispo', '$prixUnitaire');";
                      $result = mysqli_query($mysqli,$query);
                      if($result)
                      {
                          while($nomPlat = mysqli_fetch_assoc($result))
                          {
                              $success ='<p style="text-align:center; color:green"> Votre plat'.$nomPlat['nomPlat'].' a été bien ajouté !</p>';
                          }
                      }
                      $mysqli->close();
                  }
                  else
                  {
                      $erreur='<p style="text-align:center; color:red">Votre description dépasse 150 caractères!<p>';
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
}

?>

<!DOCTYPE html>
<html>
 <head>
     <meta charset="UTF-8" />
     <meta name="author" content="Manuele" />
    <title> Formulaire</title>
    <style type="text/css">
          label { display: inline-block;
                     width : 200px;
                     text-align : left;
                     font-weight: bold;
                     margin-left: 5px;
                    }
    </style>
 </head>
<body>
    <h1> Formulaire Plat </h1>
    <?php
    if (isset($erreur)) { echo $erreur; }
    if (isset($success)) { echo $success; }
    ?>
    <form name="formPlat" action="" method="POST">

                <label>Nom</label>
                <input type="text" name="nomPlat" size="20" maxlength="80" />
                <br/>

                <label>Image</label>
                <input type="text" name="urlImage" size="20" maxlength="80"   />
                <br/>

               <label>Description du plat </label>
                <input type="text" name="description" size="20" maxlength="80"   />
                <br/>

                <label>Quantité disponible </label>
                 <input type="text" name="quantiteDispo" size="20" maxlength="80"   />
                 <br/>

                <label>prix unitaire </label>
                 <input type="text" name="prixUnitaire" size="20" maxlength="80"   />
                 <br/>

                <input type="submit" value="Valider" class="bouton" />
    </form>
</body>
</html>
