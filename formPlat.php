<?php
$erreur = " ";
$success = " ";
include_once('connexionBDD.php');
if(isset($_POST["formPlat"]))
{
      if (!empty($_POST["nomPlat"] && $_POST["urlImage"] && $_POST["description"] && $_POST["quantiteDispo"] && $_POST["prixUnitaire"]))
      {
        //Récupérer les données
        $nomPlat = htmlspecialchars($_POST["nomPlat"]);
        $urlImage = htmlspecialchars($_POST["urlImage"]);
        $description = $_POST["description"];
        $quantiteDispo = $_POST["quantiteDispo"];
        $prixUnitaire = $_POST["prixUnitaire"];
            //verification: nombre de caractère saisie correspond au nbre de caractère paramétré en base de données
            $nomPlatLength=strlen($nomPlat);
            if($nomPlatLength <=150)
            {
              //verification: nombre de caractère saisie correspond au nbre de caractère paramétré en base de données
                $urlImageLength=strlen($urlImage);
                if($urlImageLength<=150)
                {
                  //verification: nombre de caractère saisie correspond au nbre de caractère paramétré en base de données
                    $descriptionLength=strlen($description);
                    if($descriptionLength<=250)
                    {
                      //verification: nombre de quantité saisie de caractère saisie correspond au nbre de caractère paramétré en base de données
                          $quantiteDispoLenght=strlen($quantiteDispo);
                          if($quantiteDispoLenght<=5){
                            $prixUnitaireLenght=strlen($prixUnitaire);
                            if($prixUnitaireLenght<=5){
                              if($prixUnitaire>0){
                                  if($quantiteDispo>0){

                                      $query = "INSERT INTO plat(nomPlat, urlImage, description, quantiteDispo, prixUnitaire)
                                                        VALUES ('$nomPlat','$urlImage','$description', '$quantiteDispo', '$prixUnitaire');";
                                      $result = mysqli_query($mysqli,$query);
                                      if ($result)
                                      {
                                        $query="SELECT * FROM plat where nomPlat='$nomPlat';";
                                        $result=mysqli_query($mysqli,$query);
                                        if($result)
                                        {
                                          while($NomPlat = mysqli_fetch_assoc($result))
                                          {
                                              $success='<p style="text-align:center; color:green"> '.$NomPlat['nomPlat'].'a été ajouté !</p>';
                                          }
                                        }

                                      }
                                      else
                                      {
                                          $echec ='<p style="text-align:center; color:red">Votre plat n\'a pas pu être ajouté à la liste de plat disponible, veuillez rééssayer !</p>';
                                      }
                                      $mysqli->close();
                                  }else{
                                    $erreur ='<p style="text-align:center; color:red"> Veuillez entrer un nombre positif dans le champs quantité disponible!';
                                  }
                                }else{
                                  $erreur ='<p style="text-align:center; color:red"> Veuillez entrer un nombre positif dans le champs prix unitaire!';
                                }
                            }else{
                              $erreur ='<p style="text-align:center; color:red"> Veuillez entrer un nombre avec 5 chiffres dans le champs prix unitaire!';
                            }

                          }else{
                            $erreur ='<p style="text-align:center; color:red"> Veuillez entrer un nombre avec 5 chiffres !';
                          }
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
                $erreur='<p style="text-align:center; color:red">Veuillez saisir un nom de plat ayant moins de 150 caractères !<p>';
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
     <link rel="stylesheet" href="./css/styleForm.css"/>
    <title> Ajouter un plat</title>
</head>
<body>
    <h1> Ajout un plat </h1>
    <p>Veuillez compléter les champs demandés</p>
    <div>
    <?php
    if (isset($erreur)) { echo $erreur; }
    if (isset($success)) { echo $success; }
    ?>
   </div>
   <div id="principale">
      <form name="formPlat" action="" method="POST">
                  <label>Nom</label>
                  <input type="text" id="nomPlat" name="nomPlat" placeholder="Saisissez le nom de votre plat" size="40" maxlength="150" />
                  <br/>

                  <label>Image</label>
                  <input type="text" id="urlImage" name="urlImage" placeholder="Saisissez l'URL de votre image" size="40" maxlength="150" />
                  <br/>

                  <label>Description du plat </label>
                  <input type="text" id="description" name="description" placeholder="Saisissez la description de votre plat" size="40" maxlength="250" />
                  <br/>

                  <label>Quantité disponible </label>
                  <input type="number" id="quantiteDispo" name="quantiteDispo" placeholder="Saisissez la quantité disponible de votre plat" size="40" maxlength="6" />
                  <br/>

                  <label>Prix unitaire </label>
                  <input type="number" id="prixUnitaire" name="prixUnitaire" placeholder="Saisissez le prix unitaire de votre plat" size="40" maxlength="5" />
                  <br/>

                  <input name="formPlat" type="submit" value="Ajouter votre plat" class="bouton" />

      </form>
    </div>
</body>
</html>
