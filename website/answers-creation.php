<?php
  session_start(); // Démarre une nouvelle session ou reprend une session existante
  $mysqli = mysqli_connect("127.0.0.1", "root", "", "2proj"); // connexion à la base de donnée
?>
<meta charset="utf-8">
<form id="answers-creation" action="answers-creation.php" method="post">
		<!-- Choix de réponse -->
		<label>• </label>
		<input type="text" name="add_answer" size="50" maxlength="100" placeholder="Saisissez un choix de réponse" value="" />
        <input type="submit" name="Add_anwser" value="+" /> <!-- onclick="moreQuestion()" -->
		<input type="submit" name="Del_answer" value="x" /> <!-- onclick="deleteQuestion()" -->
		<br>
		<label>• </label>
		<input type="text" name="add_answer" size="50" maxlength="100" placeholder="Saisissez un choix de réponse" value="" />
        <input type="submit" name="Add_anwser" value="+" />
        <input type="submit" name="Del_answer" value="x" />
        <br> <br>
        <!-- si la réponse était du text alors on termine direction le questionnaire sinon on créer le choix de réponse -->
        <input type="submit" name="next" value="Question suivante">
        <!-- $qNumber++; -->
        <input type="submit" name="end" value="Terminer">
</form>

<?php
	if (isset($_POST['next']) || isset($_POST['end'])){ // ok 
		// echo "requete";
	}
    if (isset($_POST['next'])){ // ok
        header('location: question-creation.php');
    }

	if (isset($_POST['end'])){ //ok
		$_SESSION['qNumber'] = 1;
		header('location: display.php');
    }
?>

<script>
		var qNumber = 3; 
		function moreQuestion() {
	  		// document.getElementById("answers-creation").style.color = "red";
			if(qNumber <= 4) { // nb max de question (5)
				qNumber++;
			}
            console.log(qNumber);
		}	

		function deleteQuestion() {
  			//document.getElementById("demo2").style.color = "blue";
			if(qNumber > 2) { // nb min de réponse (2)
				qNumber--;
			}
            console.log(qNumber);
		}
</script>
