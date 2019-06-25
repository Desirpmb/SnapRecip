<?php
$erreur = " ";
$success = " ";
include_once('connexionBDD.php');
$varId=$_GET [ 'varId' ] ;
$query = "SELECT * FROM Plat WHERE Id='$varId'";
$resultat = mysqli_query($mysqli,$query);
$ligne = $resultat->fetch_assoc();

if (isset($_POST["nomPlat"]) && isset($_POST["urlImage"]) && isset($_POST["description"]) && isset($_POST["quantiteDispo"]) && isset($_POST["prixUnitaire"])){
  if (!empty($_POST["nomPlat"] && $_POST["urlImage"] && $_POST["description"] && $_POST["quantiteDispo"] && $_POST["prixUnitaire"]))
  {
   if ($_POST["nomPlat"]!=$ligne['nomPlat'] || $_POST["urlImage"]!=$ligne['urlImage'] || $_POST["description"]!=$ligne['description'] || $_POST["quantiteDispo"]!=$ligne['quantiteDispo'] || $_POST["prixUnitaire"]!=$ligne['prixUnitaire'])
   {
    $nomPlat = $_POST["nomPlat"];
    $urlImage = $_POST["urlImage"];
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
          if($quantiteDispoLenght<=5)
          {
            $prixUnitaireLenght=strlen($prixUnitaire);
            if($prixUnitaireLenght<=5)
            {
              if($prixUnitaire>0)
              {
                if($quantiteDispo>0)
                {
                  $nomPlat=addslashes($nomPlat);
                  $query = "UPDATE Plat SET nomPlat='$nomPlat', urlImage='$urlImage', description='$description', quantiteDispo='$quantiteDispo', prixUnitaire='$prixUnitaire' WHERE Id='$varId'";
                  $result = mysqli_query($mysqli,$query);
                  if($result)
                  {
                    $success='<p style="text-align:center; color:lightgreen"> '.$NomPlat['nomPlat'].' a été modifié !</p>';
                    header("Location: home.php");
                  }
                  else{
                    $echec ='<p style="text-align:center; color:orange">Votre plat n\'a pas pu être modifié. Veuillez rééssayer !</p>';
                  }
                }
                else{
                  $erreur ='<p style="text-align:center; color:orange"> Veuillez entrer un nombre positif dans le champ quantité disponible!';
                }
              }
              else{
                $erreur ='<p style="text-align:center; color:orange"> Veuillez entrer un nombre positif dans le champ prix unitaire!';
              }
            }
            else{
              $erreur ='<p style="text-align:center; color:orange"> Veuillez entrer un nombre de moins de 5 chiffres dans le champ prix unitaire!';
            }
          }
          else{
            $erreur ='<p style="text-align:center; color:orange"> Veuillez entrer un nombre de moins de 5 chiffres !';
          }
        }
        else{
          $erreur='<p style="text-align:center; color:orange">Votre description dépasse 250 caractères!<p>';
        }
      }
      else{
        $erreur='<p style="text-align:center; color:orange">Votre nom d\'image dépasse 150 caractères!<p>';
      }
    }
    else{
      $erreur='<p style="text-align:center; color:orange">Veuillez saisir un nom de plat ayant moins de 150 caractères !<p>';
    }
  }
  else{
   $erreur='<p style="text-align:center; color:orange">Veuillez apporter au moins une modification !<p>';
 }
}
else{
  $erreur='<p style="text-align:center; color:orange">L\'un des champs n\'a pas été complété !<p>';
}
}
?>

<!DOCTYPE html>
<html>
<head>
 <meta charset="UTF-8" />
 <meta name="author" content="Manuele" />
 <link rel="stylesheet" href="./css/styleForm.css"/>
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
 <title> Modifier un plat</title>
</head>
<body>
 <a href="./home.php"><button class="btn"><i class="fa fa-home"></i></button></a>
 <div class="form-area">
  <h1> Modifier un plat </h1>
  <?php
  if (($erreur == " ") && ($success == " ")) { echo "<p id='test'>Veuillez modifier le ou les champ(s) souhaité(s)<br/>Au moins une modification doit être apportée</p>";}
  if (isset($erreur)) { echo $erreur; }
  if (isset($success)) { echo $success; }
  ?>
  <form name='formPlat' action='' method='POST'>
    <label>Nom</label>
    <input type="text" id="nomPlat" name="nomPlat" value="<?php echo $ligne['nomPlat']; ?>" size="40" maxlength="150" />

    <label>Image</label>
    <input type="text" id="urlImage" name="urlImage" value="<?php echo $ligne['urlImage']; ?>" size="40" maxlength="150" />

    <label>Description du plat </label>
    <input type="text" id="description" name="description" value="<?php echo $ligne['description']; ?>" size="40" maxlength="250" />

    <label>Quantité disponible </label>
    <input type="number" id="quantiteDispo" name="quantiteDispo" value="<?php echo $ligne['quantiteDispo']; ?>" size="40" maxlength="6" />

    <label>Prix unitaire </label>
    <input type="number" step="0.1" id="prixUnitaire" name="prixUnitaire" value="<?php echo $ligne['prixUnitaire']; ?>" size="40" maxlength="5" />

    <input name='formPlat' type='submit' value='Modifier le plat sélectionné' class='bouton'" />
  </form>"
      <!-- ?>
      -->    </div>
    </body>
    </html>
