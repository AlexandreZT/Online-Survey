<?php
  session_start(); // Démarre une nouvelle session ou reprend une session existante
  $mysqli = mysqli_connect("127.0.0.1", "root", "", "2proj"); // connexion à la base de donnée
?>
<meta charset="utf-8">
<p>Exemple de rendu d'affichage sur le tableau de bord: ce n'est pas un sondage réel</p> <!-- votre sondage : id = $id, sondage 1 -->
<!-- zone de text -->
<form action="display.php" method="post">
		<label>Quelles sont vos suggestions ?</label><br> <!-- votre question : id = $id, sondage 1, question 1 -->
		<!-- choix reponse : id = $id, sondage 1, question 1, réponse 1 -->
		<textarea style="resize: none" name="message" cols="40" rows="5" placeholder="Saississez votre réponse"></textarea>
 <br>
	
<!-- choix unique -->

	<label>Votre genre ?</label><br> <!-- votre question : id = $id, sondage 1, question 2 -->
	<input type="radio" id="male" name="gender" value="male">
	<label for="male">Homme</label><br> <!-- choix reponse : id = $id, sondage 1, question 2, réponse 1 -->
	<input type="radio" id="female" name="gender" value="female">
	<label for="female">Femme</label><br> <!-- choix reponse : id = $id, sondage 1, question 2, réponse 2 -->
	<input type="radio" id="other" name="gender" value="other">
	<label for="other">Autre</label>
 <br>
	
<!-- multiple -->

	<label>Vos compétences ?</label><br> <!-- votre question : id = $id, sondage 1, question 3 -->
	<input type="checkbox" id="scales" name="scales">
	<label for="scales">Java</label> <!-- choix reponse : id = $id, sondage 1, question 3, réponse 1 -->
	<br>
	<input type="checkbox" id="horns" name="horns">
    <label for="horns">Python</label> <!-- choix reponse : id = $id, sondage 1, question 3, réponse 2 -->
    <br>
    <input type="submit" name="quit" value="Quitter">
</form>

<?php
    if (isset($_POST['quit'])){ //ok
		header('location: index.php');
    }
?>


