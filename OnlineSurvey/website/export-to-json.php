<head>
    <meta charset="utf-8">
    <!-- Favicons -->
    <link href="assets/img/favicon3.png" rel="icon">
</head>

<?php
if (!isset($_SESSION['pseudo'])) { 
    echo "Vous devez vous connecter"; // puis entrer le pseudo du créateur du poll et l'id du poll"; // si quelqu'un est connecté

} else {
    session_start(); // Démarre une nouvelle session ou reprend une session existante
    $mysqli = mysqli_connect("127.0.0.1", "root", "", "2proj"); // connexion à la base de donnée

    $req_download = $mysqli->query("SELECT * FROM analyses WHERE `creator` = $_SESSION[id]");

    $surveyArray = array();

    while($row = mysqli_fetch_assoc($req_download))
    {
        $surveyArray[] = $row;
    }

    $fp = fopen('MySurveyData.json', 'w');
    fwrite($fp, json_encode($surveyArray, JSON_UNESCAPED_UNICODE));
    fclose($fp);
    echo "<p style='text-align:center; margin-top:15%'>Vos données de sondages ont été téléchargé, redirection dans 3 secondes !</p>";
    header("refresh:3; url=dashboard.php"); 
}
?>