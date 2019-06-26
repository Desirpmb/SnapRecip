 <?php
session_start();
include_once('connexionBDD.php');
$erreur = " ";
$success = " ";

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
    echo "Plat ID :".$id."<br/>";
    echo "quantite demandée : ".$qtDemande."<br/>";
    // vérification que la quantité renseigné est strictement positif
    if(!($qtDemande == 0))
    {
      echo "Quantité demandée n'égale pas à 0 <br/>";
      //récupération des quantités disponibles dans la table plat
      $queryRecup = "SELECT * FROM plat WHERE Id=$id";
      $result = mysqli_query($mysqli,$queryRecup);
      $platExist= mysqli_num_rows($result);
      if($platExist)
      {
        while ($ligne = $result->fetch_assoc())
        {
          //récupération des quantité disponible du plat et de son nom
          $qtPlatDispo = $ligne['quantiteDispo'];
          $nomPlat = $ligne['nomPlat'];

          echo "Nom de plat demandé : ".$nomPlat."<br/>";
          echo "Quantité plat disponible : ".$qtPlatDispo."<br/>";
          $qtPlatDispo=(int)$qtPlatDispo;

        }
        if(!($qtPlatDispo==0))
        {
          //vérification que le nombre d'unité demandé pour le plat soit disponible
          if($qtPlatDispo>=$qtDemande)
          {
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
                echo "Votre numéro panier : ".$numPanier."<br/>";
              }
            }
            else
            {
              echo "Vous avez déjà un panier ! <br/>";
              $queryNPan = "SELECT * FROM panier WHERE email_Utilisateur='$emailUser'";
              $resultNPan = mysqli_query($mysqli,$queryNPan);
              while($num = mysqli_fetch_assoc($resultNPan))
              {
                $numPanier = $num['id'];
                echo "Votre numéro panier : ".$numPanier."<br/>";
              }
            }

            //Verifier si ligne panier existe
            $queryLP = "SELECT * FROM LignePanier WHERE Panier_id='$numPanier' AND Plat_id='$id'";
            $resultLP = mysqli_query($mysqli,$queryLP);
            $LPExist= mysqli_num_rows($resultLP);

            if(!$LPExist==0)
            {
              while($qtLPtable = mysqli_fetch_assoc($resultLP))
              {
                $qtLP = $qtLPtable['quantite'];
                echo $qtLP."<br/>";
                echo $qtDemande."<br/>";

              }
              $newQtLP = $qtDemande + $qtLP;
              echo $newQtLP."<br/>";
              $qtLPupdate = "UPDATE LignePanier SET quantite = '$newQtLP' WHERE Panier_id='$numPanier' AND Plat_id='$id'";
              $resultatQTLPupdate = mysqli_query($mysqli,$qtLPupdate);
              echo "MAJ de votre panier :".$nomPlat." réussi ! <br/>";
            }
            else
            {
              //Ajouter une ligne panier
              $queryAjoutLP = "INSERT INTO LignePanier(quantite, Panier_id, Plat_id) VALUES ('$qtDemande','$numPanier','$id')";
              $resultAjoutLP = mysqli_query($mysqli,$queryAjoutLP);
              echo "Ajout du plat :".$nomPlat." réussi ! <br/>";
            }


            //enlever la quantite disponible de la table Plat
            $newQuantiteDis = $qtPlatDispo - $qtDemande;
            $quantiteUpt = "UPDATE Plat SET quantiteDispo = '$newQuantiteDis' WHERE Id = '$id'";
            $resultatQtUpt = mysqli_query($mysqli,$quantiteUpt);

            $queryNewQtDis = "SELECT * FROM Plat WHERE Id='$id'";
            $resultNewQtDis = mysqli_query($mysqli,$queryNewQtDis);
            while($numQtDis = mysqli_fetch_assoc($resultNewQtDis))
            {
              $afficheNewQtDis = $numQtDis['quantiteDispo'];
              echo "Nouvelle qt de :".$nomPlat." = ".$afficheNewQtDis."<br/>";
            }

            //Récupérer prix unitaire de chaque plat dans le panier et sommer
            $queryPrixUni = "SELECT * FROM Plat P
                                      INNER JOIN LignePanier LP
                                      ON P.Id = LP.Plat_id
                                      INNER JOIN Panier Pn
                                      ON LP.Panier_id = Pn.id WHERE Pn.id ='$numPanier'";
            $resultPrixUni = mysqli_query($mysqli,$queryPrixUni);
            while($PrixUniTable = mysqli_fetch_assoc($resultPrixUni))
            {
              $affichePrix = $PrixUniTable['prixUnitaire'];
              $afficheNomPlat = $PrixUniTable['nomPlat'];
              $afficherQt = $PrixUniTable['quantite'];
              echo "PU :".$afficheNomPlat." = ".$affichePrix." Qantité : ".$afficherQt."<br/>";
              //Calculer le prix PrixTotal
              $mttotalProduit = $afficherQt*$affichePrix;
              $total = $total + $mttotalProduit;
            }
              echo $total."<br/>";

            //insérer le prix total dans le Panier
            $queryInsertPT = "UPDATE Panier SET prixTotal = '$total' WHERE Id = '$numPanier'";
            $resultInsertPT = mysqli_query($mysqli,$queryInsertPT);
            echo "réussi ! <br/>";

            //Supprimer 
            //inserer ligne commande dans le Panier
            //presentation du panier sous forme de tableau

          }
          else
          {
            $erreur ="<p>Il n'y a plus que ".$qtPlatDispo." ".$nomPlat."</p>";
            echo $erreur;
          }
        }
        else
        {
          // vérification que la valeur quantité dans la table plat n'est pas égale à 0
          $erreur ="<p>Le plat ".$nomPlat." n'est plus disponible</p>";
          echo $erreur;
        }
      }
      else
      {
        $erreur ="<p>Le plat sélectionner n'est pas disponible !</p>";
        echo $erreur;
      }
    }
    else
    {
      $erreur ="<p>Votre quantité doit être supérieur à 0</p>";
      echo $erreur;
    }
  }
  else
  {
    $erreur ="<p>Vous n'avez pas renseigné de quantité!</p>";
  }
}
else
{
  $erreur ="<p>Il faut être connecté pour pouvoir ajouter un plat !</p>";
  echo $erreur;
}

$mysqli->close();

?>
