
<meta charset="utf-8">

<?php
    //Step 1: Open MySQL Database Connection in PHP
    //open connection to mysql db
    session_start(); // Démarre une nouvelle session ou reprend une session existante
    $connection = mysqli_connect("127.0.0.1","root","","2proj") or die("Erreur " . mysqli_error($connection));

    //Step 2: Fetch Data from MySQL Database

    //fetch table rows from mysql db
    $sql = "SELECT * FROM analyses WHERE `creator` = $_SESSION[id]";
    $result = mysqli_query($connection, $sql) or die("Erreur " . mysqli_error($connection));

    //Step 3: Convert MySQL Result Set to PHP Array

    //create an array
    $emparray = array();
    while($row = mysqli_fetch_assoc($result))
    {
        $emparray[] = $row;
    }

    //Convertion tableau PHP en Chaine JSON (+ affichage)
 
    // echo json_encode($emparray);
    
    //Step 5: Convert MySQL to JSON File in PHP

    //write to json file
    $fp = fopen('MySurveyData.json', 'w');
    fwrite($fp, json_encode($emparray));
    fclose($fp);
    echo "Vos données de sondages ont bien été téléchargé !"
?>