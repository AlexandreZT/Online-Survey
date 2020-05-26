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
		// echo "<p>Votre id : $_SESSION[id]</p> </br>";
		echo "<p id='welcome'>Bonjour $_SESSION[pseudo]</p>";
	?>


	<section id="questionnaire">
	
	<form id="creation"> <!-- Type de réponse, option obligatoire, choix de réponse-->
		<label for="question">Donner un titre à votre sondage :</label>
		<br>
		<!-- <textarea style="resize: none" name="Text1" cols="40" rows="2" placeholder="Saisissez un titre de sondage"></textarea> -->
        <input type="text" id="question" name="question" size="50" maxlength="100" placeholder="Saisissez un titre de sondage">
        <input type="submit" name="create_survey" value="Créer">
		<p>// new screen</p>
		<label>Q1</label> <!-- $qNumber-->
		<input type="text" id="question" name="question" size="50" maxlength="100" placeholder="Saisissez votre question">
        <!-- choix type de réponse -->
		<select name="Type de réponse" size="1">
			<option value="unique">Choix unique</option>
			<option value="multiple">Choix multiple</option>
			<option value="text">Zone de text</option>
		</select>
        <!-- option de réponse obligatoire (if empty alors invalide) -->
        <label>obligatoire</label>
		<input type="checkbox" id="obligatoire" name="obligatoire">
		<br> <br>
		<!-- Choix de réponse -->
		<label>• </label>
        <input type="text" name="add_answer" size="50" maxlength="100" placeholder="Saisissez un choix de réponse" value="" />
        <input type="submit" name="Add_anwser" value="+" />
		<input type="submit" name="Del_answer" value="x" />
		<br>
		<label>• </label>
		<input type="text" name="add_answer" size="50" maxlength="100" placeholder="Saisissez un choix de réponse" value="" />
        <input type="submit" name="Add_anwser" value="+" />
		<input type="submit" name="Del_answer" value="x" />
		<br>
		<label>• </label>
		<input type="text" name="add_answer" size="50" maxlength="100" placeholder="Saisissez un choix de réponse" value="" />
        <input type="submit" name="Add_anwser" value="+" />
        <input type="submit" name="Del_answer" value="x" />
        <br> <br>
        <input type="submit" value="Question suivante">
        <input type="submit" value="Terminer">
	</form>
	<p>// new screen</p>
	<p>Exemple de rendu :</p> <!-- votre sondage : id = $id, sondage 1 -->
	<!-- zone de text -->
	<form action method="post">
		<label>Quelles sont vos suggestions ?</label><br> <!-- votre question : id = $id, sondage 1, question 1 -->
		<textarea name="message" rows="10" cols="30" placeholder="enter your text here"></textarea>	<!-- choix reponse : id = $id, sondage 1, question 1, réponse 1 -->
	</form>
	<br>
	
	<!-- choix unique -->
	<form>
		<label>Votre genre ?</label><br> <!-- votre question : id = $id, sondage 1, question 2 -->
		<input type="radio" id="male" name="gender" value="male">
		<label for="male">Homme</label><br> <!-- choix reponse : id = $id, sondage 1, question 2, réponse 1 -->
		<input type="radio" id="female" name="gender" value="female">
		<label for="female">Femme</label><br> <!-- choix reponse : id = $id, sondage 1, question 2, réponse 2 -->
		<input type="radio" id="other" name="gender" value="other">
		<label for="other">Autre</label>
	</form>
	<br>
	
	<!-- multiple -->
	<form>
		<label>Vos compétences ?</label><br> <!-- votre question : id = $id, sondage 1, question 3 -->
		<input type="checkbox" id="scales" name="scales">
		<label for="scales">Java</label> <!-- choix reponse : id = $id, sondage 1, question 3, réponse 1 -->
		<br>
		<input type="checkbox" id="horns" name="horns">
		<label for="horns">Python</label> <!-- choix reponse : id = $id, sondage 1, question 3, réponse 2 -->
	</form>
	</section>
    <?php
    }
    else {
        echo "connexion requise";
    }
	?>
	
	<?php
		// permet d'ajouter une todolist
		if (isset($_POST['create_survey'])) {
			$req_add = $mysqli->query("INSERT INTO surverys (`title`,`status`) VALUES ('$_POST[create_survey]', 0)"); // `` permit to escape reserved word like status, '' doesn't work !
		}
	?>
	
    <script src="script.js"></script>
  </body>
</html>

