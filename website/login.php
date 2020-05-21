<?php

session_start(); // à mettre tout en haut du fichier .php, cette fonction propre à PHP servira à maintenir la $_SESSION
if (isset($_POST['connexion'])) { // si le bouton "Connexion" est appuyé
    // on vérifie que le champ "Pseudo" n'est pas vide
    // empty vérifie à la fois si le champ est vide et si le champ existe belle et bien (is set)
    if (empty($_POST['pseudo'])) {
        $logerror = "Le champ Pseudo est vide.";
    } else {
        // on vérifie maintenant si le champ "Mot de passe" n'est pas vide"
        if (empty($_POST['mdp'])) {
            $logerror =  "Le champ Mot de passe est vide.";
        } else {
            // les champs sont bien posté et pas vide, on sécurise les données entrées par le membre:
            $Pseudo = htmlentities($_POST['pseudo'], ENT_QUOTES, "ISO-8859-1"); // le htmlentities() passera les guillemets en entités HTML, ce qui empêchera les injections SQL
            $MotDePasse = htmlentities($_POST['mdp'], ENT_QUOTES, "ISO-8859-1");
            //on se connecte à la base de données:
            $mysqli = mysqli_connect("127.0.0.1", "root", "", "2proj");
            //on vérifie que la connexion s'effectue correctement:
            if (!$mysqli) {
                $logerror =  "Erreur de connexion à la base de données.";
            } else {
                // on fait maintenant la requête dans la base de données pour rechercher si ces données existe et correspondent:
                $Requete = mysqli_query($mysqli, "SELECT * FROM membre WHERE pseudo = '" . $Pseudo . "' AND mdp = '" . md5($MotDePasse) . "'"); //si vous avez enregistré le mot de passe en md5() il vous suffira de faire la vérification en mettant mdp = '".md5($MotDePasse)."' au lieu de mdp = '".$MotDePasse."'
                // si il y a un résultat, mysqli_num_rows() nous donnera alors 1
                // si mysqli_num_rows() retourne 0 c'est qu'il a trouvé aucun résultat
                if (mysqli_num_rows($Requete) == 0) {
                    $logerror =  "The username or password is incorrect, the account was not found..";
                } else {
                    // on ouvre la session avec $_SESSION:
                    $_SESSION['pseudo'] = $Pseudo; // la session peut être appelée différemment et son contenu aussi peut être autre chose que le pseudo
                    $open = true;// $session_status = session_status();
                }
            }
        }
    }
}
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
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

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
        <!--<h1 class="text-light"><a href="index.php"><span>Vesperr</span></a></h1>-->
        <!-- Uncomment below if you prefer to use an image logo -->
        <a href="index.php"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>
      </div>

      <nav class="nav-menu d-none d-lg-block">
        <ul>
          <li class="active"><a href="index.php">Accueil</a></li>
          <li><a href="#about">Nous concernant</a></li>
          <li><a href="#services">Services</a></li>
          <li><a href="#portfolio">Exemples</a></li>
          <li><a href="#pricing">Abonnements</a></li>
          <!--<li class="drop-down"><a href="">Drop Down</a>
            <ul>
              <li><a href="#">Drop Down 1</a></li>
              <li class="drop-down"><a href="#">Drop Down 2</a>
                <ul>
                  <li><a href="#">Deep Drop Down 1</a></li>
                  <li><a href="#">Deep Drop Down 2</a></li>
                  <li><a href="#">Deep Drop Down 3</a></li>
                  <li><a href="#">Deep Drop Down 4</a></li>
                  <li><a href="#">Deep Drop Down 5</a></li>
                </ul>
              </li>
              <li><a href="#">Drop Down 3</a></li>
              <li><a href="#">Drop Down 4</a></li>
              <li><a href="#">Drop Down 5</a></li>
            </ul>
          </li>
          <li><a href="#contact">Contact</a></li>-->

          <li class="get-started"><a href="login.php">Connexion</a></li>
          <li class="get-started"><a href="signin.php">Inscription</a></li>
          <li><button id="dark-mode">Dark Mode</button> </li>
        </ul>
      </nav><!-- .nav-menu -->

    </div>
  </header>
  <!-- End Header -->

   <!-- ======= Login Form======= -->

   <div id="login-container">
    <form class="login" action="login.php" method="post">
        <h2>Heureux de vous revoir !</h2>
        <label><b>Nom d'Utilisateur</b></label>
        <input type="text" name="pseudo" placeholder="Veuillez saisir votre nom d'utilisateur" value="" />
        <label><b>Mot de Passe</b></label>
        <input type="password" name="mdp" placeholder="Veuillez saisir votre mot de passe" value="" />
        <a href="registration.php"></a>

        <input type="submit" name="connexion" value="Log In" />
        
    </form>
</div>

    <?php
        if (isset($logerror)) {
            echo "<p>$logerror</p>";
        }
        if ((isset($Pseudo) and isset($open))) {
            echo "<p><b>You're connected $Pseudo!</b></p>";
            // echo "<p>Status de la sessions : $session_status </p>";
            $req_id = $mysqli->query("SELECT id FROM membre WHERE pseudo = '$_SESSION[pseudo]'");
            $row = mysqli_fetch_array($req_id); // sous forme de tableau
            $_SESSION['id'] = $row['id']; // Je récupère l'id
        }
    ?>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/jquery/jquery.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/jquery.easing/jquery.easing.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/waypoints/jquery.waypoints.min.js"></script>
  <script src="assets/vendor/counterup/counterup.min.js"></script>
  <script src="assets/vendor/owl.carousel/owl.carousel.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/venobox/venobox.min.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/login-main.js"></script>

</body>

</html>