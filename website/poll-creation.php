<?php
  session_start(); // Démarre une nouvelle session ou reprend une session existante
  $mysqli = mysqli_connect("127.0.0.1", "root", "", "2proj"); // connexion à la base de donnée
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <title>formulaire</title>
    <link href="style.css" rel="stylesheet" type="text/css" />
  </head>
  <body>
  
  <?php
	if (isset($_SESSION['pseudo'])) { // si un utilisateur est connecté
		// echo "<p id='welcome'>Bonjour $_SESSION[pseudo]</p>"; 
		// echo "<p id='welcome'>Ton id : $_SESSION[id]</p>";
	?> 
	
	<form id="create_surveys" action="poll-creation.php" method="post"> <!-- Type de réponse, option obligatoire, choix de réponse-->
		<label><b>Donner un titre à votre sondage :</b></label>
		<br>
        <input type="text" name="create_surveys" size="50" maxlength="100" placeholder="Saisissez un titre de sondage" value="">
		<br>
		<input type="submit" name="Create_Surveys" value="Créer"> <!-- onclick="redirect()" -->

	</form>

	<?php
		// permet de créer un sondage
		if (isset($_POST['create_surveys'])) {
			// $_SESSION['qNumber'] = 1;
			$req_surveys = $mysqli->query("INSERT INTO surveys (`owner`, `title`,`status`) VALUES ($_SESSION[id], '$_POST[create_surveys]', 0)"); // `` permit to escape reserved word like status, '' doesn't work !
			// max id
			$req_max = $mysqli->query("SELECT MAX(id) FROM `surveys` WHERE `owner` = '$_SESSION[id]'"); // on pourrait même edit les sondages
			$row = mysqli_fetch_array($req_max);
			$_SESSION['max'] = $row['MAX(id)']; // Je récupère l'id max
			// echo "max : $_SESSION[max]";
			 
			// récupère l'id du sondage
			$req_id = $mysqli->query("SELECT id FROM surveys WHERE `id` = '$_SESSION[max]'"); // récup le dernier sondage créé
			$row = mysqli_fetch_array($req_id); // sous forme de tableau
			$_SESSION['poll'] = $row['id']; // Je récupère l'id pour la clé étrangère
			// echo " ma clé : $_SESSION[poll]";
			header('location: question-creation.php');
		}	
	?>

    <?php
    }
    else {
        echo "connexion requise";
    }
	?>

  </body>
</html>