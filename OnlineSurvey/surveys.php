<?php
  session_start(); // Démarre une nouvelle session ou reprend une session existante
  $mysqli = mysqli_connect("127.0.0.1", "root", "", "2proj"); // connexion à la base de donnée
?>

<!-- Ce fichier permet à un membre de Online Survey de répondre au questionnaire d'une personne -->
<!-- Pour que le sondage soit disponible, il faut que le status d'activation soit activé -->
<!-- Si il a déjà répondu au questionnaire il n'aura pas le droit de répondre à nouveau -->
<!-- on y répond anonymement -->

<meta charset="utf-8">

<form id="find_surveys" action="surveys.php" method="post">
        <h2>Accèdez au questionnaire de votre choix</h2>
        <label><b>Pseudo du Créateur</b></label>
        <input type="text" name="owner_pseudo" placeholder="Pseudo du Propriétaire" value="" />
        <label><b>ID du Poll</b></label>
        <input type="number" name="poll_id" placeholder="Id du Poll" maxlength='5' value="" />

        <input type="submit" name="search" value="Accès au questionnaire" />
    </form>
<?php


if (!isset($_SESSION['pseudo'])) { 
		echo "Vous devez vous connecter"; // puis entrer le pseudo du créateur du poll et l'id du poll"; // si quelqu'un est connecté
} else if (isset($_POST['search'])) {                          
	$req_owner_id = $mysqli->query("SELECT `id` FROM members WHERE `pseudo` = '$_POST[owner_pseudo]'");
	$req_owner_id->data_seek(0);
	$row = $req_owner_id->fetch_assoc();
	$owner_id = $row['id']; // ok jusque là
	$_SESSION['owner_id'] = $owner_id;

	$req_owner_surv = $mysqli->query("SELECT `title` FROM surveys WHERE `owner` = $owner_id AND `id` = '$_POST[poll_id]'");
	$req_owner_surv->data_seek(0);
	$row = $req_owner_surv->fetch_assoc();
	$title = $row['title'];
	$_SESSION['poll_id'] = $_POST['poll_id'];

	echo "<h2 style='text-decoration: underline;'>$title</h2>";
	$req_owner_quest = $mysqli->query("SELECT * FROM questions WHERE `poll` = '$_POST[poll_id]'"); // question / mandatory / type
	$req_owner_quest->data_seek(0);
	$_SESSION['qNum'] = 1;
	while ($row = $req_owner_quest->fetch_assoc()) {
		echo "<h4>$row[question]</h4>";
		$quest_id = $row['id'];
		$quest_type = $row['type'];
		$quest_mandatory = $row['mandatory'];
		$req_owner_answ = $mysqli->query("SELECT * FROM answers WHERE `choice` = $quest_id");
		$req_owner_answ->data_seek(0);

		?> <form id="submit_answers" action="surveys.php" method="post"> <?php

		$aNum = 1;
		while ($row = $req_owner_answ->fetch_assoc()) {																											 
			//Affichage des réponses de chaque questions de chaque sondage	
			
    		if ($quest_type == 2) { // si c'est une réponse textuelle
				if ($quest_mandatory == 1) { // si c'est obligatoire (TRUE)
					?> <textarea style="resize: none" name="text<?php echo "$_SESSION[qNum]"?>" cols="40" rows="5" placeholder="Saississez votre réponse" minlength='20' maxlength='400'></textarea> <?php
				}
				else {
					?> <textarea style="resize: none" name="text<?php echo "$_SESSION[qNum]"?>" cols="40" rows="5" placeholder="Saississez votre réponse" maxlength='400'></textarea> <?php
				}
				$row['answer'] = ""; // ne rien afficher à l'écran
			}
			else if ($quest_type == 1) { // si c'est une réponse multiple
				if ($quest_mandatory == 1 ) { // si c'est obligatoire (TRUE)
					?> <input type="checkbox" name="multiple<?php echo "$_SESSION[qNum]$aNum"?>" value="<?php echo "$aNum"?>"/> <?php
				}
				else {
					?> <input type="checkbox" name="multiple<?php echo "$_SESSION[qNum]$aNum"?>" value="<?php echo "$aNum"?>"/> <?php
				}
			}
			
			else { // ($quest_type == 0) si c'est une réponse unique
				if ($quest_mandatory == 1) { // si c'est obligatoire (TRUE)
					?> <input type="radio" name="unique<?php echo "$_SESSION[qNum]"?>" value="<?php echo "$aNum"?>"/><?php // checked
				}
				else {
					?> <input type="radio" name="unique<?php echo "$_SESSION[qNum]"?>" value="<?php echo "$aNum"?>"/><?php // onclick="document.getElementById('id').checked = false;"	
				}	
			}
			echo "$row[answer] $_SESSION[qNum]$aNum</br>";
			$aNum++;
		}
		$_SESSION['qNum']++;
	}
	$_SESSION['qNum']--; // enlève l'incrémentation de trop lorsque l'on sort de la boucle
	?> </br> </br> <input type="submit" name="soumettre" value="Soumettre mes réponses"/> </form> <?php
}																											
?>

<?php
    if (isset($_POST['soumettre'])) {
		$qCount = 1;
		$aCount = 1;
		// echo "$_SESSION[qNum]"; // nb de boucle à traité par question
		while ($qCount <= $_SESSION['qNum']) {
			if (isset($_POST["unique$qCount"])){
				while ($aCount <= 5) { // nb max de reponse par question
					if($_POST["unique$qCount"] == $aCount) // selection reponse 1
					{
						$req_answ_to_analyse = $mysqli->query("INSERT INTO `analyses` (`respondent`, `creator`, `survey`, `question`,`answer`) VALUES ($_SESSION[id], $_SESSION[owner_id], $_SESSION[poll_id], $qCount, $aCount)");
					}
					$aCount++;			
				}
				$aCount = 1; // reinit
			}	
			// debut par un while
			while ($aCount < 5) { // nb max de reponse par question
				if (isset($_POST["multiple$qCount$aCount"])){
					$req_answ_to_analyse = $mysqli->query("INSERT INTO `analyses` (`respondent`, `creator`, `survey`, `question`,`answer`) VALUES ($_SESSION[id], $_SESSION[owner_id], $_SESSION[poll_id], $qCount, $aCount)");
				}
				$aCount++;
			}
			$aCount = 1; // reinit
			
			if (isset($_POST["text$qCount"])){
				$text_query = "text$qCount";
				$req_answ_to_analyse = $mysqli->query("INSERT INTO `analyses` (`respondent`, `creator`, `survey`, `question`,`answer`) VALUES ($_SESSION[id], $_SESSION[owner_id], $_SESSION[poll_id], $qCount, '$_POST[$text_query]')");		
			}
			$qCount++;
		}
		echo "Merci, vos réponses ont bien été prises en compte";
		
	}
?>