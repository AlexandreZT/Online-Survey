<?php
  session_start();
  $mysqli = mysqli_connect("127.0.0.1", "root", "", "2proj"); // connexion à la base de donnée
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Connexion | Check Survey</title>
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
  <link href="assets/css/login-style.css" rel="stylesheet">

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top d-flex align-items-center">
    <div class="container d-flex align-items-center">

      <div class="logo mr-auto">
        <!--<h1 class="text-light"><a href="index.php"><span>Vesperr</span></a></h1>-->
        <!-- Uncomment below if you prefer to use an image logo -->
        <a href="index.php"><img src="assets/img/banner3.png" alt="" class="img-fluid"></a>
      </div>

      <nav class="nav-menu d-none d-lg-block">
        <ul>
        <li><a href="#about">Plus d'Infos</a></li>
          <li><a href="#pricing">Tarification & Abonnements</a></li>
          <li><a href="dashboard.php">Tableau de bord</a></li>

          <?php
              if(isset($_SESSION['pseudo'])) {
            ?> 
            <!--<li class="get-started"><a href="logout.php">Déconnexion</a></li>-->
            <script type="text/javascript">
			      	window.location.href = 'dashboard.php';
			      </script>
            <?php
              }
              else {
            ?>
            <li class="get-started"><a href="login.php">Connexion</a></li>
            <?php
          }
          ?>
        </ul>
      </nav><!-- .nav-menu -->

    </div>
  </header>

  <div id="container">
        <form class="login" action="signin.php" method="post"> <!-- nom de class prete à confusion -->
            <h2><b>Rejoignez-nous !</b></h2>
            <label><b>Nom d'Utilisateur<span class="infobulle" aria-label="Uniquement les caractères miniscules et chiffres sont autorisés"> *</span></b></label>
            <input type="text" name="pseudo" placeholder="Veuillez saisir un nom d'utilisateur" value="" />
            <label><b>Mot de Passe</b></label>
            <input type="password" name="mdp" placeholder="Veuillez saisir un mot de passe" value="" />
            <label><b>Adresse Mail</b></label>
            <input type="text" name="mail" placeholder="Veuillez saisir une adresse mail" value="" />
            <a id="already" href="login.php"><h6 style="text-align:center">Déja inscrit ?</h6></a>
            <input type="submit" name="connexion" value="Je m'inscris" />
        </form>
    </div>
  <?php

//connexion à la base de données:
$BDD = array();
$BDD['host'] = "127.0.0.1";
$BDD['user'] = "root";
$BDD['pass'] = "";
$BDD['db'] = "2proj";
// $dbh = new PDO('mysql:host=localhost;dbname=test', $user, $pass); // php
$mysqli = mysqli_connect($BDD['host'], $BDD['user'], $BDD['pass'], $BDD['db']);
if (!$mysqli) {
  $loginfo = "<p>Connexion non établie.</p>";
    exit;
}
//création automatique de la table members, une fois créée, vous pouvez supprimer les lignes de code suivantes:
mysqli_query($mysqli, "CREATE TABLE IF NOT EXISTS `" . $BDD['db'] . "`.`members` ( `id` INT NOT NULL AUTO_INCREMENT , `pseudo` VARCHAR(25) NOT NULL, `mail` VARCHAR(25) NOT NULL, `mdp` CHAR(32) NOT NULL , PRIMARY KEY (`id`)) ENGINE = MyISAM;") . mysqli_error($mysqli);
//la table est créée avec les paramètres suivants:
//champ "id": en auto increment pour un id unique, peux vous servir pour une identification future
//champ "pseudo": en varchar de 0 à 25 caractères
//champ "mail": en varchar de 0 à 25 caractères
//champ "mdp": en char fixe de 32 caractères, soit la longueur de la fonction md5()
//fin création automatique
//par défaut, on affiche le formulaire (quand il validera le formulaire sans erreur avec l'inscription validée, on l'affichera plus)
//$AfficherFormulaire = 1;
// traitement du formulaire d'inscription :
if (isset($_POST['pseudo'], $_POST['mail'], $_POST['mdp'])) { //l'utilisateur à cliqué sur "S'inscrire", on demande donc si les champs sont défini avec "isset"
    if (empty($_POST['pseudo'])) { //le champ pseudo est vide, on arrête l'exécution du script et on affiche un message d'erreur
      echo "<p id='reginfo' >Le champ Pseudo est vide.</p>";
    } elseif (!preg_match("#^[a-z0-9]+$#", $_POST['pseudo'])) { //le champ pseudo est renseigné mais ne convient pas au format qu'on souhaite qu'il soit, soit: que des lettres minuscule + des chiffres
      echo "<p id='reginfo'>Le Pseudo doit être renseigné en lettres minuscules sans accents, sans caractères spéciaux.</p>";
    } elseif (strlen($_POST['pseudo']) > 25) { // Le pseudo est trop long, il dépasse 25 caractères
      echo "<p id='reginfo'>Le pseudo est trop long, il dépasse 25 caractères.</p>";
    } elseif (empty($_POST['mail'])) { // Le champ mail est vide
      echo "<p id='reginfo'>Le champ Mail est vide.</p>";
    } elseif (empty($_POST['mdp'])) { // Le champ mot de passe est vide
      echo "<p id='reginfo'>Le champ Mot de passe est vide.</p>";
    } elseif (mysqli_num_rows(mysqli_query($mysqli, "SELECT * FROM members WHERE pseudo='" . $_POST['pseudo'] . "'")) == 1) { //on vérifie que ce pseudo n'est pas déjà utilisé par un autre membre
      echo "<p id='reginfo'>Ce pseudo est déjà utilisé.</p>";
    } else {
        //toutes les vérifications sont faites, on passe à l'enregistrement dans la base de données:
        //Bien évidement il s'agit là d'un script simplifié au maximum, libre à vous de rajouter des conditions avant l'enregistrement comme la longueur minimum du mot de passe par exemple
        if (!mysqli_query($mysqli, "INSERT INTO members SET pseudo='" . $_POST['pseudo'] . "', mail='" . $_POST['mail'] . "', mdp='" . md5($_POST['mdp']) . "'")) { //on crypte le mot de passe avec la fonction propre à PHP: md5()
          $loginfo = "Une erreur s'est produite: " . mysqli_error($mysqli); //je conseille de ne pas afficher les erreurs aux visiteurs mais de l'enregistrer dans un fichier log
        } else {
          ?>
			      <script type="text/javascript">
			      	window.location.href = 'login.php';
			        </script>
		        <?php
        }
    }
}
?>