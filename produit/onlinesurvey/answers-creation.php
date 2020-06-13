<?php
  session_start(); // Démarre une nouvelle session ou reprend une session existante
  $mysqli = mysqli_connect("127.0.0.1", "root", "", "2proj"); // connexion à la base de donnée
?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Création du formulaire</title>
  <meta content="" name="descriptison">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon3.png" rel="icon">
  
  <!-- Google Fonts --> 
  <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/icofont/icofont.min.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="assets/vendor/venobox/venobox.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/survey-style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Vesperr - v2.0.0
  * Template URL: https://bootstrapmade.com/vesperr-free-bootstrap-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>
    <!-- ======= Header ======= -->
	<header id="header" class="fixed-top d-flex align-items-center">
	    <div class="container d-flex align-items-center">

	      <div class="logo mr-auto">
	        <!--<h1 class="text-light"><a href="index.html"><span>Vesperr</span></a></h1>-->
	        <!-- Uncomment below if you prefer to use an image logo -->
	        <a href="index.php"><img src="assets/img/banner3.png" alt="" class="img-fluid"></a>
	      </div>

	      <nav class="nav-menu d-none d-lg-block">
	        <ul>
	          <!--<li class="active"><a href="#header">Accueil</a></li>-->
	          <li><a href="#about">Plus d'Infos</a></li>
	          <li><a href="#pricing">Tarification & Abonnements</a></li>
	          <li><a href="poll-creation.php">Questionnaire</a></li>
	
	          <?php
	              if(isset($_SESSION['pseudo'])) {
	            ?> 
	            <li class="get-started"><a href="logout.php">Déconnexion</a></li>
	            <!-- <li class="get-started"><a href="login.php">Connexion</a></li> -->
	            <?php
	              }
	              else {
	            ?>
	            <li class="get-started"><a href="login.php">Connexion</a></li>
	            <!-- <li><a href="logout.php">Déconnexion</a></li> -->
	            <?php
	          }
	          ?>
	        </ul>
	      </nav>
	      <!-- .nav-menu -->

	    </div>
  </header>
  <!-- End Header -->
<div id="form">
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
</div>


<?php
	if (isset($_POST["Add"])) {
		if($_SESSION['choiceNumber'] <= 4) { // nb max de question (5)
			$_SESSION['choiceNumber']++;
		}
		?>
			<script type="text/javascript">
				window.location.href = 'answers-creation.php';
			</script>
		<?php
	}

	if (isset($_POST["Del"])) { //  && ($_POST["Del"]) == "x 1 "
		if($_SESSION['choiceNumber'] > 2) { // nb min de réponse (2)
			$_SESSION['choiceNumber']--;
		}
		?>
			<script type="text/javascript">
				window.location.href = 'answers-creation.php';
			</script>
		<?php
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
	}

	if ((isset($_POST['next']) || isset($_POST['end'])) && $_SESSION['type'] == 2){ // si c'est une réponse libre, on laisse quand même une allocation réponse par dafaut
		$req_answers = $mysqli->query("INSERT INTO answers (`choice`, `answer`) VALUES ($_SESSION[choice], 'réponse libre')");

	}

	if (isset($_POST['next'])){
		?>
			<script type="text/javascript">
				window.location.href = 'question-creation.php';
			</script>
		<?php
    }

	if (isset($_POST['end'])){ //ok
		$_SESSION['qNumber'] = 1;
		?>
			<script type="text/javascript">
				window.location.href = 'dashboard.php';
			</script>
		<?php
    }
?>

</script>
	
	<body>
</html>