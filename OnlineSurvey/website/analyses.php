<?php
  session_start(); // Démarre une nouvelle session ou reprend une session existante
  $mysqli = mysqli_connect("127.0.0.1", "root", "", "2proj"); // connexion à la base de donnée
?>

<head>
    <meta charset="utf-8">
    <!-- Favicons -->
    <link href="assets/img/favicon3.png" rel="icon">
</head>

<?php
if (!isset($_SESSION['pseudo'])) { 
    echo "Vous devez vous connecter"; // puis entrer le pseudo du créateur du poll et l'id du poll"; // si quelqu'un est connecté

} else {
    $surveyList = array();
    $req_analyses = $mysqli->query("SELECT * FROM analyses WHERE `creator`= $_SESSION[id]");
    $req_analyses->data_seek(0);
    while ($row = $req_analyses->fetch_assoc()) { // regarde chaque ligne
        array_push($surveyList, $row['survey']); // 51515151515151535353535353
    }
    
    $currentsurv = 0;
    foreach($surveyList as $surv) {
        if($currentsurv != $surv) {
            $currentsurv = $surv;
            $req_nb_quest = $mysqli->query("SELECT MAX(question) FROM analyses WHERE `creator`= $_SESSION[id] AND `survey`= $currentsurv");
            $row2 = mysqli_fetch_array($req_nb_quest);
            $max_quest = $row2['MAX(question)'];
            echo "Sondage n° : $currentsurv </br>";
            $question = 1;
            while ($question <= $max_quest) {
                $answer = 1;
                echo "Question $question : ";
                while ($answer <= 5) {
                    $req_count = $mysqli->query("SELECT COUNT(answer) FROM analyses WHERE `creator`= $_SESSION[id] AND `survey`= $currentsurv AND question = $question AND answer = $answer");
                    // $req_comment = $mysqli->query("SELECT answer FROM analyses WHERE question = $question AND answer NOT LIKE = '%[^0-9]%'");
                    
                    $count_row = $req_count->fetch_assoc();
                    $test = $count_row['COUNT(answer)'];
                    if ($test != 0)
                    {
                        echo "réponse n°$answer = $test, ";
                     }
                    $answer++;
                }              
                $req_comment = $mysqli->query("SELECT answer FROM analyses WHERE `survey`= $currentsurv AND question = $question");
                while ($comment_row = $req_comment->fetch_assoc()) {
                    if ($comment_row['answer'] != 1 && $comment_row['answer']  != 2 && $comment_row['answer']  != 3 && $comment_row['answer']  != 4 && $comment_row['answer']  != 5) {
                        echo "$comment_row[answer] -";
                    }
                }
            echo "<br>";
            $question++;      
            }
        }
    }
}
?>