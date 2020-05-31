<?php
  session_start(); // Démarre une nouvelle session ou reprend une session existante
  $mysqli = mysqli_connect("127.0.0.1", "root", "", "2proj"); // connexion à la base de donnée
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
    </head>
    <body>

<?php
	if ($_SESSION['type'] == 2) { // si c'est une réponse libre (texte)
		?>
		<form id="text-answers-creation" action="answers-creation.php" method="post">
		<textarea disabled style="resize: none" name="message" cols="40" rows="5" placeholder="Réponse libre de vos clients"></textarea>
		<br>
        <!-- si la réponse était du text alors on termine direction le questionnaire sinon on créer le choix de réponse -->
        <input type="submit" name="next" value="Question suivante">
        <!-- $qNumber++; -->
        <input type="submit" name="end" value="Terminer">
		</form>
		<?php
	} else { // si c'est une réponse au choix (unique ou multiple)
		$i = 1; // compteur

		if(!isset($_SESSION['choiceNumber'])) {
			$_SESSION['choiceNumber'] = 3; // nb de réponse par défaut
		}  

		while ($i <= $_SESSION['choiceNumber']) {
?>

<form id="answers-creation" action="answers-creation.php" method="post">
		<!-- Choix de réponse -->
		<label>• </label>
		<input type="text" name="answer<?php echo "$i"?>" size="50" maxlength="100" placeholder="Saisissez un choix de réponse" value="" />
        <input type="submit" name="Add" value="+" />
		<input type="submit" name="Del" value="x" />
        <br> <br> 
<?php 
		$i++;
		}
		?>
		<!-- si la réponse était du text alors on termine direction le questionnaire sinon on créer le choix de réponse -->
        <input type="submit" name="next" value="Question suivante">
        <!-- $qNumber++; -->
        <input type="submit" name="end" value="Terminer">
</form>

		<?php
	}
?>


<?php
	if (isset($_POST["Add"])) {
		if($_SESSION['choiceNumber'] <= 4) { // nb max de question (5)
			$_SESSION['choiceNumber']++;
		}
		header('location: answers-creation.php');
	}

	if (isset($_POST["Del"])) { //  && ($_POST["Del"]) == "x 1 "
		if($_SESSION['choiceNumber'] > 2) { // nb min de réponse (2)
			$_SESSION['choiceNumber']--;
		}
		header('location: answers-creation.php');
	}

	if ((isset($_POST['next']) || isset($_POST['end'])) && $_SESSION['type'] != 2){ // On envoie les requetes de choix de réponses si ce n'est pas une réponse libre
		
		$req_answers = $mysqli->query("INSERT INTO answers (`choice`, `answer`) VALUES ($_SESSION[choice], '$_POST[answer1]')");
		$req_answers = $mysqli->query("INSERT INTO answers (`choice`, `answer`) VALUES ($_SESSION[choice], '$_POST[answer2]')");
	
		if ($_SESSION['choiceNumber'] >= 3)  {
			$req_answers = $mysqli->query("INSERT INTO answers (`choice`, `answer`) VALUES ($_SESSION[choice], '$_POST[answer3]')");
		}
		if ($_SESSION['choiceNumber'] >= 4)  {
			$req_answers = $mysqli->query("INSERT INTO answers (`choice`, `answer`) VALUES ($_SESSION[choice], '$_POST[answer4]')");
		}
		if ($_SESSION['choiceNumber'] >= 5)  {
			$req_answers = $mysqli->query("INSERT INTO answers (`choice`, `answer`) VALUES ($_SESSION[choice], '$_POST[answer5]')");
		}
		//echo "requete";
	}
    if (isset($_POST['next'])){ // ok
        header('location: question-creation.php');
    }

	if (isset($_POST['end'])){ //ok
		$_SESSION['qNumber'] = 1;
		header('location: display.php');
    }
?>

</script>
	
	<body>
</html>
