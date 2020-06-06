<?php
  session_start(); // Démarre une nouvelle session ou reprend une session existante
  $mysqli = mysqli_connect("127.0.0.1", "root", "", "2proj"); // connexion à la base de donnée
?>

<meta charset="utf-8">

<?php
    $surveyList = array();
    $req_analyses = $mysqli->query("SELECT * FROM analyses WHERE `creator`= $_SESSION[id]");
    $req_analyses->data_seek(0);
    while ($row = $req_analyses->fetch_assoc()) { // regarde chaque ligne
        
        if (!isset($max_quest))
        {
            $req_nb_quest = $mysqli->query("SELECT MAX(question) FROM analyses WHERE `creator`= $_SESSION[id]");
            $row2 = mysqli_fetch_array($req_nb_quest);
            $max_quest = $row2['MAX(question)'];
        }
        array_push($surveyList, $row['survey']); // 51515151515151535353535353
    }
    
    $currentsurv = 0;
    foreach($surveyList as $surv) {
        
        if($currentsurv != $surv) {
            $currentsurv = $surv;
            echo "Sondage n° : $currentsurv </br>";
            $question = 1;
            while ($question <= $max_quest) {
                $answer = 1;
                echo "Question $question : ";
                while ($answer <= 5) {
                    $req_analyses = $mysqli->query("SELECT COUNT(answer) FROM analyses WHERE question = $question and answer = $answer");
                    $row = $req_analyses->fetch_assoc();
                    $test = $row['COUNT(answer)'];
                    echo "$test-";
                    $answer++;
                }
            echo "<br>";
            $question++;      
            }
        }
    }
?>