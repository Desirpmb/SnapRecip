<!DOCTYPE html>
<html>
 <head>
     <meta charset="UTF-8" />
     <meta name="author" content="Manuele" />
    <title> Ajouter un plat</title>
</head>
<body>
    <h1> Formulaire Plat </h1>

    <form name="formPlat" action="ActionAddPlat.php" method="POST">

                <label>Nom</label>
                <input type="text" id="nomPlat" name="nomPlat" placeholder="Saisissez le nom de votre plat" size="40" maxlength="150" />
                <br/>

                <label>Image</label>
                <input type="text" id="urlImage" name="urlImage" placeholder="Saisissez l'URL de votre image" size="40" maxlength="150" />
                <br/>

               <label>Description du plat </label>
                <input type="text" name="descriptionPlat" size="20" maxlength="80"   />

                <label>Description du plat </label>
                <input type="text" id="description" name="description" placeholder="Saisissez la description de votre plat" size="40" maxlength="250" />
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
