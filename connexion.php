<?php
session_start();
$erreur = " ";
$success = " ";
include_once('connexionBDD.php');

if(isset($_POST['formConnexion']))
{
    if (!empty($_POST["emailClient"] && $_POST["motdepasse"]))
    {
        $email =htmlspecialchars( $_POST["emailClient"]);
        $motDePasse =sha1($_POST["motdepasse"]);

        if(filter_var($email, FILTER_VALIDATE_EMAIL))
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
                <h1 class="title-form">Connexion</h1>
                <?php
                if (isset($erreur)) { echo $erreur; }
                if (isset($success)) { echo $success; }
                ?>
                <form name="formClient" action="" method="POST">
                    <!--Email-->
                    <div class="label">
                        <label for="Email">Email</label><br/>
                    </div>
                    <input type="email" id="email" name="emailClient" placeholder="Votre Email" size="40" maxlength="150" />
                 <br/>

                    <!--Mot de passe-->
                    <div class="label">
                        <label for="motdepasse">Mot de passe</label><br/>
                    </div>
                    <input type="password" id="mdp" name="motdepasse" placeholder="Tapez votre mot de passe" size="40" maxlength="150" />
                 <br/>
                    <!--Bouton pour valider inscription-->
                    <div class="button-signUp">
                    <input name="formConnexion" id="inscription" type="submit" value="Connexion" class="button" />
                    </div>
                </form>
                <!--input type="submit" value="Se connecter" class="bouton"-->
            </div>
        </div>
    </body>
</html>

