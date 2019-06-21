<?php
include_once('connexionBDD.php');
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
    <h1> Formulaire Plats </h1>

    <form name="formPlat" action="" method="POST">

                <label>Nom</label>
                <input type="text" name="nomPlat" size="20" maxlength="80" />
                <br/>

                <label>Image</label>
                <input type="text" name="urlImage" size="20" maxlength="80"   />
                <br/>

               <label>Description du plat </label>
                <input type="text" name="descriptionPlat" size="20" maxlength="80"   />
                <br/>

                <label>Quantité disponible </label>
                 <input type="text" name="quantiteDispo" size="20" maxlength="80"   />
                 <br/>

                <label>prix unitaire </label>
                 <input type="text" name="prixunitaire" size="20" maxlength="80"   />
                 <br/>

                <input type="submit" value="Valider" class="bouton" />
    </form>
</body>
</html>
