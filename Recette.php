<!DOCTYPE html>
<html>
<head>
	<title>Recettes</title>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="../css/recettes.css"/>
</head>
<body>
	<?php 
		include_once('connexionBDD.php');
		
		if ($mysqli->connect_errno) {
			die ("Echec lors de la connexion ". $mysqli->connect_error);
		}

		//recuperer données recettes
		$sql = "SELECT * FROM recettes" ;
		$resultat = $mysqli->query($sql);


		echo "<div id='conteneur'>";
		while ($ligne = $resultat->fetch_assoc()) {
			echo  "<div class='recette'>
			<img class='illustration' src='Images/" . $ligne['image']."' >
			<div class='nom'>" . $ligne['nom'] ."</div><div class='description'>" . $ligne['description'] ."</div><div id='ajout'><input type='button' value='Ajouter au panier'></div></div>";
		}
		echo "</div>";
		$mysqli->close();
	?>
</body>
</html>