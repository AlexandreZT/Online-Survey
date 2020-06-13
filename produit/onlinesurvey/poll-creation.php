<?php
  session_start(); // Démarre une nouvelle session ou reprend une session existante
  $mysqli = mysqli_connect("127.0.0.1", "root", "", "2proj"); // connexion à la base de donnée
?>

<!DOCTYPE html>
<html lang="en">

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
  
  <?php
	if (isset($_SESSION['pseudo'])) { // si un utilisateur est connecté
		// echo "<p id='welcome'>Bonjour $_SESSION[pseudo]</p>"; 
		// echo "<p id='welcome'>Ton id : $_SESSION[id]</p>";
	?> 
	<div id="form">
		<form id="create_surveys" action="poll-creation.php" method="post"> <!-- Type de réponse, option obligatoire, choix de réponse-->
			<label><b>Donner un titre à votre sondage :</b></label>
			<br>
    	    <input type="text" name="create_surveys" size="50" maxlength="100" placeholder="Saisissez un titre de sondage" value="">
			<input type="submit" name="Create_Surveys" value="Suivant"> <!-- onclick="redirect()" -->
		</form>
	</div>

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