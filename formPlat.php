<?php
include_once('connexionBDD.php');
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
                <input type="text" name="" size="20" maxlength="80"   />
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
