<?php
$erreur = " ";
$success = " ";
include_once('connexionBDD.php');
//On récupère les données du formulaire
if(isset($_POST['formInscription']))
{
    
    if (!empty($_POST["nomClient"] && $_POST["prenomClient"] && $_POST["sexe"] && $_POST["emailClient"] && $_POST["naissance"] && $_POST["motdepasse"])) 
    {
          $nom =htmlspecialchars($_POST["nomClient"]);
          $prenom = htmlspecialchars($_POST["prenomClient"]);
          $sexe =$_POST["sexe"];
          $email = $_POST["emailClient"];
          $dateNaissance =$_POST["naissance"];
          $motDePasse =sha1($_POST["motdepasse"]);
          $confMotDePasse =sha1($_POST["confmotdepasse"]);

          //verification du nombre de caractère saisie
          $nomLength=strlen($nom);
          if($nomLength <=30)
          {
              $prenomLength=strlen($prenom);
              if($prenomLength<=15)
              {
                  if(filter_var($email, FILTER_VALIDATE_EMAIL))
                  {
                      $query="SELECT * FROM Utilisateur WHERE Email='$email';";
                      $result=mysqli_query($mysqli,$query);
                      $emailExist= mysqli_num_rows($result);
                      if($emailExist == 0)
                      {
                          if($motDePasse==$confMotDePasse)
                          {
                            $query = "INSERT INTO Utilisateur(Nom, Prenom, Sexe, DateNaissance, Email, MotDePasse) VALUES ('$nom', '$prenom', '$sexe', '$dateNaissance', '$email', '$motDePasse');";
                              $result = mysqli_query($mysqli,$query);
                              if($result)
                              {
                                  $query = "SELECT * FROM Utilisateur WHERE Email = '$email';";
                                  $result = mysqli_query($mysqli,$query);
                                      if($result)
                                      {
                                          while($Prenom = mysqli_fetch_assoc($result))
                                          {
                                              $success='<p style="text-align:center; color:green"> Vous êtes bien inscrit! bienvenue parmi nous '.$Prenom['Prenom'].'</p>';
                                          }
                                      }
                                      else
                                      {
                                              $erreur='<p style="text-align:center; color:red">Inscription échouée, veuillez vous réinscrire !<p>';
                                      }
      
                              }
                                  $mysqli->close();

                          }
                          else
                          {
                              $erreur='<p style="text-align:center; color:red">Veuillez saisir le même mot de passe<p>';
                          }


                      }
                      else
                      {
                          $erreur='<p style="text-align:center; color:red">Cette adresse mail est déjà existante, veuillez en choisir une autre !<p>';
                      }
                  }
                  else
                  {
                      $erreur='<p style="text-align:center; color:red">Votre adresse mail n\'est pas valide !<p>';
                  }
              }
              else
              {
                  $erreur='<p style="text-align:center; color:red">Votre prénom dépasse 15 caractères!<p>';
              }

          }
          else
          {
              $erreur='<p style="text-align:center; color:red">Votre nom dépasse 30 caractères !<p>';
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
        <title>Snap Recipe - inscription</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="./css/styleInscription.css"/>
        <!-- pour télécharger les font proposer par google -->
        <link href="https://fonts.googleapis.com/css?family=Great+Vibes&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body>
        <div class="content">
            <div class="container-image">
                <img class="image" src="./Images/mediterraneanProfil.jpg" >
            </div>
            <div class="formulaire">
           <a href="./home.php"><button class="btn"><i class="fa fa-home"></i></button></a>
            <h1 class="title-form">Inscription</h1>
                <?php
                if (isset($erreur)) { echo $erreur; }
                if (isset($success)) { echo $success; }
                ?>
                <form name="formInscription" action="" method="POST">
                    <!--Sexe avec des boutons radio-->
                    <div class="label">
                        <label for="sexe">Sexe:</label><br/>
                    </div>
                    <INPUT id="radio" type="radio" name="sexe" value="F"> Femme
                    <INPUT id="radio" type="radio" name="sexe" value="H"> Homme
                <br/>

                    <!--Nom-->
                    <div class="label">
                        <label for="nom">Nom:</label><br/>
                    </div>
                    <input type="text" id="nom" name="nomClient" placeholder="Votre nom" size="40" maxlength="150" />
                <br/>

                    <!--Prénom-->
                    <div class="label">
                        <label for="Prenom">Prénom:</label><br/>
                    </div>
                    <input type="text" id="prenom" name="prenomClient" placeholder="Votre prenom" size="40" maxlength="150" />
                <br/>

                    <!--date de naissance -->
                    <div class="label">
                        <label for="naissance">Date de naissance :</label><br/>
                    </div>
                    <input type="date" id="naissance" name="naissance" value="2018-07-22" min="1920-01-01" max="2019-12-31"/>
                <br/>


                    <!--Email-->
                    <div class="label">
                        <label for="Email">Email :</label><br/>
                    </div>
                    <input type="email" id="email" name="emailClient" placeholder="Votre Email" size="40" maxlength="150" />
                 <br/>

                    <!--Mot de passe-->
                    <div class="label">
                        <label for="motdepasse">Mot de passe :</label><br/>
                    </div>
                    <input type="password" id="mdp" name="motdepasse" placeholder="Tapez votre mot de passe" size="40" maxlength="150" />
                 <br/>
                    <!--Confirmation mot de passe-->
                    <div class="label">
                        <label for="motdepasse">Confirmation du mot de passe :</label><br/>
                    </div>
                    <input type="password" id="mdp" name="confmotdepasse" placeholder="Saisissez de nouveau votre mot de passe" size="40" maxlength="150" />
                 <br/>

                    <!--Bouton pour valider inscription-->
                    <div class="button-signUp">
                    <input name="formInscription" id="inscription" type="submit" value="Inscription" class="button" />
                    </div>
                </form>
                   <!--input type="submit" value="Se connecter" class="bouton"-->
            </div>
        </div>
    </body>
</html>
