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
  <link href="assets/img/favicon.png" rel="icon">
  
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
    <form id="create_questions" action="question-creation.php" method="post">
        <label>
            <?php echo "Q";
                if(!isset($_SESSION['qNumber'])){
                    $_SESSION['qNumber'] = 1;   
                }
                echo"$_SESSION[qNumber]";
            ?>
        </label> <!-- $qNumber-->
        <input type="text" name="question" size="50" maxlength="100" placeholder="Saisissez votre question">
        <!-- choix type de réponse -->
        <select name="type" size="1" > <!-- onchange="this.form.submit()" -->
            <!--<option value="none">type de réponse</option> no value -->
            <option value="unique">Choix unique</option>
            <option value="multiple">Choix multiple</option>
            <option value="text">Zone de text</option>
        </select>
        <!-- option de réponse obligatoire (if empty alors invalide) -->
        <label>obligatoire</label>
        <input type="checkbox" name="obligatoire" value="TRUE">
        <br>
        <input type="submit" name="create_questions" value="Passer aux réponses">

    </form>

    <?php
    if (isset($_POST['create_questions'])) { //ok
        if(empty($_POST['obligatoire']))
        {
            $obligatoire = 0; // false
        }
        else {
            $obligatoire = 1; // true
        }	
        if ($_POST['type'] == "unique") {
            $_SESSION['type'] = 0; // "unique"
        }
        else if ($_POST['type'] == "multiple") {
            $_SESSION['type'] = 1; // "multiple"
        }
        else {
            $_SESSION['type'] = 2; // "text"
        }

        $req_questions = $mysqli->query("INSERT INTO questions (`poll`, `question`, `mandatory`,`type`) VALUES ($_SESSION[poll], '$_POST[question]', $obligatoire, $_SESSION[type])");


        $req_max = $mysqli->query("SELECT MAX(id) FROM `questions` WHERE `poll` = '$_SESSION[poll]'");
    	$row = mysqli_fetch_array($req_max);
        $_SESSION['max'] = $row['MAX(id)']; // Je récupère l'id max

        // récupère l'id de la question
    	$req_id = $mysqli->query("SELECT id FROM questions WHERE `id` = '$_SESSION[max]'"); // récup le dernier sondage créé
    	$row = mysqli_fetch_array($req_id); // sous forme de tableau
    	$_SESSION['choice'] = $row['id']; // Je récupère l'id pour la clé étrangère

        //$req_questions = $mysqli->query("INSERT INTO questions (`poll`, `question`, `mandatory`,`type`) VALUES (33, 'hacked', 1, 2");

        $_SESSION['qNumber']+=1;
        header('location: answers-creation.php');
    }

    ?>

<body>

</html>