<?php
$erreur = " ";
$success = " ";
include_once('connexionBDD.php');
<<<<<<< HEAD
if(isset($_POST['formConnexion']))
{
    if (!empty($_POST["nomPlat"] && $_POST["urlImage"] && $_POST["descriptionPlat"] && $_POST["quantiteDispo"] && $_POST["prixunitaire"]))
    {
        $nomPlat =htmlspecialchars( $_POST["nomPlat"]);
        $urlImage =sha1($_POST["urlImage"]);
        $descriptionPlat =sha1($_POST["descriptionPlat"]);
        $quantiteDispo =sha1($_POST["quantiteDispo"]);
        $prixunitaire =sha1($_POST["prixunitaire"]);

        if( ($email, FILTER_VALIDATE_EMAIL))
        {
            $queryUser="SELECT * FROM Utilisateur WHERE Email='$email' AND MotDePasse='$motDePasse'";
            $result=mysqli_query($mysqli,$queryUser);
            $userExist=mysqli_num_rows($result);
            if($userExist == 1)
            {
                $userInfo=mysqli_fetch_assoc($result);
                $_SESSION['email'] = $userInfo['Email'];
               // $success='<p style="text-align:center; color:green"> Vous êtes bien connecté(e) '.$userInfo['Prenom'].'</p>';
                header("Location: home.php?email=".$_SESSION['email']);
                exit();
            }
            else
            {

                $erreur='<p style="text-align:center; color:red">l\'adresse ou le mot de passe est incorrect !<p>';
            }

        }
        else
        {
            $erreur='<p style="text-align:center; color:red">Votre adresse mail n\'est pas valide !<p>';
        }

    }
    else
    {
        $erreur='<p style="text-align:center; color:red">L\'un des champs n\'a pas été complété !<p>';
    }
}
?>



=======
if(isset($_POST['formPlat']))
{
    //Récupérer les données
    if (!empty($_POST["nomPlat"] && $_POST["urlImage"] && $_POST["description"] && $_POST["quantiteDispo"] && $_POST["prixUnitaire"]))
    {
          $nomPlat = htmlspecialchars($_POST["nomPlat"]);
          $urlImage = htmlspecialchars($_POST["urlImage"]);
          $description = $_POST["description"];
          $quantiteDispo = $_POST["quantiteDispo"];
          $prixUnitaire = $_POST["prixUnitaire"];
          $id = '\N'; /* auto-increment */

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
                      $query = "INSERT INTO Plat(Id, nomPlat, urlImage, description, quantiteDispo, prixUnitaire) VALUES ('$id','$nomPlat','$urlImage','$description', '$quantiteDispo', '$prixUnitaire')";
                      $result = mysqli_query($mysqli,$query);
                      if (!$result)
                      {
                          echo "<p>Désolée, requête impossible ! </p>";
                      }
                      else
                      {
                          $nomPlat = mysqli_fetch_assoc($result);
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
}

?>

>>>>>>> b5656df22dded275753abf9f1ccd28cd9774ed9b
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
                <input type="text" id="nomPlat" name="nomPlat" placeholder="Saisissez le nom de votre plat" size="40" maxlength="150" />
                <br/>

                <label>Image</label>
                <input type="text" id="urlImage" name="urlImage" placeholder="Saisissez l'URL de votre image" size="40" maxlength="150" />
                <br/>

<<<<<<< HEAD
               <label>Description du plat </label>
                <input type="text" name="descriptionPlat" size="20" maxlength="80"   />
=======
                <label>Description du plat </label>
                <input type="text" id="description" name="description" placeholder="Saisissez la description de votre plat" size="40" maxlength="250" />
>>>>>>> b5656df22dded275753abf9f1ccd28cd9774ed9b
                <br/>

                <label>Quantité disponible </label>
                <input type="text" id="quantiteDispo" name="quantiteDispo" placeholder="Saisissez la quantité disponible de votre plat" size="40" maxlength="5" />
                <br/>

                <label>Prix unitaire </label>
                <input type="text" id="prixUnitaire" name="prixUnitaire" placeholder="Saisissez le prix unitaire de votre plat" size="40" maxlength="5" />
                <br/>

                <input type="submit" value="Ajouter votre plat" class="bouton" />

    </form>
</body>
</html>
