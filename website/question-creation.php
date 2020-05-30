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

    //$req_questions = $mysqli->query("INSERT INTO questions (`poll`, `question`, `mandatory`,`type`) VALUES (33, 'hacked', 1, 2");

    $_SESSION['qNumber']+=1;
    header('location: answers-creation.php');
}
    
?>

    <body>
</html>