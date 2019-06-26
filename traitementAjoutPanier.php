 <?php
session_start();
include_once('connexionBDD.php');
$erreur = " ";
$success = " ";

//recupérer ID, quantite souhaitée du Plat
//$id = $_POST["ID"];
//$qtDemande = $_POST["Quantite"];

//echo $id."<br/>";
//echo $qtDemande."<br/>";

if(isset($_SESSION['email']))
{
  //Si l'utilisateur est connecté on affecte son email à la variable local $emailUser
  $emailUser = $_SESSION['email'];
  echo $emailUser."<br/>";
  if(isset($_POST["ID"], $_POST["Quantite"]))
  {
    $id = $_POST["ID"];
    $qtDemande = $_POST["Quantite"];
    $qtDemande=(int)$qtDemande;
    echo $id."<br/>";
    echo $qtDemande."<br/>";
    // vérification que la quantité renseigné est strictement positif
    if(!($qtDemande == 0)){
      echo $qtDemande."<br/>";
      //récupération des quantités disponibles dans la table plat
      $queryRecup = "SELECT * FROM plat WHERE Id=$id";
      $result = mysqli_query($mysqli,$queryRecup);
      $platExist= mysqli_num_rows($result);
      if($platExist){
        while ($ligne = $result->fetch_assoc())
        {
          //récupération des quantité disponible du plat et de son nom
        $qtPlatDispo = $ligne['quantiteDispo'];
        $nomPlat = $ligne['nomPlat'];

        echo $nomPlat."<br/>";
        echo $qtPlatDispo."<br/>";
        $qtPlatDispo=(int)$qtPlatDispo;
        var_dump($qtPlatDispo);
        var_dump($qtDemande);
        }
        if(!($qtPlatDispo==0)){
          //vérification que le nombre d'unité demandé pour le plat soit disponible
          if($qtPlatDispo>=$qtDemande){
            //Récupérer données pour savoir s'il existe déjà un panier pour Utilisateur
            $queryPan = "SELECT * FROM panier WHERE email_Utilisateur='$emailUser'";
            $resultPan = mysqli_query($mysqli,$queryPan);
            $emailExist= mysqli_num_rows($resultPan);
            //Si UserEmail n'existe pas ajouter un panier
            if($emailExist==0)
            {
              $queryAjoutPan = "INSERT INTO panier(email_Utilisateur) VALUES ('$emailUser')";
              $resultAjoutPan = mysqli_query($mysqli,$queryAjoutPan);
              //Récuperer le numéro panier appartenant à l'Utilisateur
              $queryNPan = "SELECT * FROM panier WHERE email_Utilisateur='$emailUser'";
              $resultNPan = mysqli_query($mysqli,$queryNPan);
              while($num = mysqli_fetch_assoc($resultNPan))
              {
                $numPanier = $num['id'];
                echo $numPanier."<br/>";
              }
            }else{
              echo "Vous avez déjà un panier !";
            }
          }else{
            $erreur ="<p>Il n'y a plus que ".$qtPlatDispo." ".$nomPlat."</p>";
            echo $erreur;
          }
        }else{
          // vérification que la valeur quantité dans la table plat n'est pas égale à 0
          $erreur ="<p>Le plat ".$nomPlat." n'est plus disponible</p>";
          echo $erreur;
        }
      }else{
        $erreur ="<p>Le plat sélectionner n'est pas disponible !</p>";
        echo $erreur;
      }
    }else{
      $erreur ="<p>Votre quantité doit être supérieur à 0</p>";
      echo $erreur;
    }
  }else{
    $erreur ="<p>Vous n'avez pas renseigné de quantité!</p>";
  }
}else{
  $erreur ="<p>Il faut être connecté pour pouvoir ajouter un plat !</p>";
  echo $erreur;
}
/*//récupérer les données de la table plat
$queryRecup = "SELECT * FROM plat WHERE Id=$id";
$result = mysqli_query($mysqli,$queryRecup);
while ($ligne = $result->fetch_assoc())
{
  //récupération des quantité disponible du plat et de son nom
$qtPlat = $ligne['quantiteDispo'];
$nomPlat = $ligne['nomPlat'];
}
echo $qtPlat."<br/>";*/

/*//Récupérer données pour savoir s'il existe déjà un panier pour Utilisateur
$queryPan = "SELECT * FROM panier WHERE email_Utilisateur='$emailUser'";
$resultPan = mysqli_query($mysqli,$queryPan);
$emailExist= mysqli_num_rows($resultPan);
//Si UserEmail n'existe pas ajouter un panier
if($emailExist==0)
{
  $queryAjoutPan = "INSERT INTO panier(email_Utilisateur) VALUES ('$emailUser')";
  $resultAjoutPan = mysqli_query($mysqli,$queryAjoutPan);
  //Récuperer le numéro panier appartenant à l'Utilisateur
  $queryNPan = "SELECT * FROM panier WHERE email_Utilisateur='$emailUser'";
  $resultNPan = mysqli_query($mysqli,$queryNPan);
  while($num = mysqli_fetch_assoc($resultNPan))
  {
    $numPanier = $num['id'];
  }
  echo $numPanier."<br/>";
}else{
  echo "echec";
}*/




/*//tester quantité demandée pas égale à 0
if ($qtDemande != 0)
{
  //tester quantité stock supérieur ou égale à quantité demandée
  if ($qtPlat >= $qtDemande)
  {
    echo "Quantité plat supérieur à quantité demandée !</br>";
  }

  else
  {
    echo "<p class='message' id ='message' style='color:red'> Il ne reste que ".$qtPlat." ".$nomPlat." ! </p>";
  }
}
else
{
  echo "<p class='message' id ='message' style='color:red'> La quatité ne doit pas être 0 ! </p>";
}*/

$mysqli->close();
//enlever la quantite disponible
//inserer dans ligne commeande le Plat
//soustrait la quantite que l'on souhaite ajouter à la quantiteDisponible
//PrixTotal du panier, additionner tous les produit présent dans la table ligneCommande
//presentation du oanier sous forme de tableau
?>
