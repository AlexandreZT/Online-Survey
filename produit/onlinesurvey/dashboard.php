<?php
  session_start(); // Démarre une nouvelle session ou reprend une session existante
  $mysqli = mysqli_connect("127.0.0.1", "root", "", "2proj"); // connexion à la base de donnée
?>

<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="fr">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <!-- Favicons -->
    <link href="assets/img/favicon3.png" rel="icon">

    <title>Online Survey - Tableau de Bord</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="This is an example dashboard created using build-in elements and components.">
    <meta name="msapplication-tap-highlight" content="no">
    <link href="./main.css" rel="stylesheet">
</head>

<body>
    <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
        <div class="app-header header-shadow">
            <div class="app-header__logo">
                <!--<a href="index.php"><img src="assets/img/banner3.png" alt="" class="img-fluid"></a>-->
                <div class="header__pane ml-auto">
                    <div>
                        <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="app-header__mobile-menu">
                <div>
                    <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                        <span class="hamburger-box">
                            <span class="hamburger-inner"></span>
                        </span>
                    </button>
                </div>
            </div>
            <div class="app-header__menu">
                <span>
                    <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                        <span class="btn-icon-wrapper">
                            <i class="fa fa-ellipsis-v fa-w-6"></i>
                        </span>
                    </button>
                </span>
            </div>    
            <div class="app-header__content">
                <div class="app-header-left">
                    <div class="search-wrapper">
                        <div class="input-holder">
                            <input type="text" class="search-input" placeholder="Type to search">
                            <button class="search-icon"><span></span></button>
                        </div>
                        <button class="close"></button>
                    </div>
                    <ul class="header-menu nav">
                        <li class="nav-item">
                            <a href="javascript:void(0);" class="nav-link">
                                <i class="nav-link-icon fa fa-database"> </i>
                                Statistiques
                            </a>
                        </li>
                        <li class="btn-group nav-item">
                            <a href="javascript:void(0);" class="nav-link">
                                <i class="nav-link-icon fa fa-edit"></i>
                                Projets
                            </a>
                        </li>
                        <li class="dropdown nav-item">
                            <a href="javascript:void(0);" class="nav-link">
                                <i class="nav-link-icon fa fa-cog"></i>
                                Paramètres
                            </a>
                        </li>
                    </ul>        
                </div>
                <div class="app-header-right">
                    <div class="header-btn-lg pr-0">
                        <div class="widget-content p-0">
                            <div class="widget-content-wrapper">
                                <div class="widget-content-left">
                                    
                                </div>
                                <div class="widget-content-left  ml-3 header-user-info">
                                    <div class="widget-heading">
                                    <?php
                                        if (isset($_SESSION['pseudo'])) {
                                            echo "<h6 style='color:white'> $_SESSION[pseudo]</h6>";
                                        }
                                        else echo "<h6 style='color:white'>Mode visiteur</h6>";       
                                            ?>
                                        
                                    </div>
                                    <div class="widget-subheading">
                                        <p style="color:white">Membre</p>
                                    </div>
                                </div>
                                <div class="btn-group">
                                    <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="p-0 btn">
                                        <i class="fa fa-angle-down ml-2 opacity-8"></i>
                                    </a>
                                    <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu dropdown-menu-right">
                                        <button type="button" tabindex="0" class="dropdown-item">Mon comptes</button>
                                        <button type="button" tabindex="0" class="dropdown-item">Paramètres</button>
                                        <button type="button" tabindex="0" class="dropdown-item">Contact</button>
                                        <div tabindex="-1" class="dropdown-divider"></div>
                                        <form action="logout.php">
                                            <input tabindex="0" class="dropdown-item" type="submit" value="Se déconnecter" />
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>        </div>
            </div>
        </div>        <div class="app-main">
                <div class="app-sidebar sidebar-shadow">
                    <div class="app-header__logo">
                        <div class="logo-src"></div>
                        <div class="header__pane ml-auto">
                            <div>
                                <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                                    <span class="hamburger-box">
                                        <span class="hamburger-inner"></span>
                                    </span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="app-header__mobile-menu">
                        <div>
                            <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                                <span class="hamburger-box">
                                    <span class="hamburger-inner"></span>
                                </span>
                            </button>
                        </div>
                    </div>
                    <div class="app-header__menu">
                        <span>
                            <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                                <span class="btn-icon-wrapper">
                                    <i class="fa fa-ellipsis-v fa-w-6"></i>
                                </span>
                            </button>
                        </span>
                    </div>    <div class="scrollbar-sidebar">
                        <div class="app-sidebar__inner">
                            <ul class="vertical-nav-menu">
                                <li class="app-sidebar__heading">Tableaux de bord</li>
                                <li>
                                    <a href="#" class="mm-active">
                                        Tableau de bord
                                    </a>
                                </li>
                                
                                <li class="app-sidebar__heading">Actions</li>
                                <li>
                                    <a href="export-to-json.php">
                                        <i class="metismenu-icon pe-7s-download">
                                        </i>Télécharger les réponses
                                    </a>
                                </li>
                                <li>
                                    <a href="analyses.php">
                                        <i class="metismenu-icon pe-7s-graph3"> 
                                        </i>Analyse des sondages
                                    </a>
                                </li>
                                <li>
                                <a href="surveys.php" target="_blank">
                                        <i class="metismenu-icon pe-7s-pen">
                                        </i>
                                        Répondre à un questionnaire
                                    </a>
                                </li>
                                <li class="app-sidebar__heading">Offres</li>
                                <li>
                                    <a href="#pricing" target="_blank">
                                    <i class="metismenu-icon pe-7s-rocket"></i>
                                        </i>
                                        Abonnements et tarifs
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                    <div class="app-main__outer">
                    <div class="app-main__inner">
                        <div class="app-page-title">
                            <div class="page-title-wrapper">
                                <div class="page-title-heading">
                                    <div>Votre tableau de bord
                                        <div class="page-title-subheading"></div>
                                        <a href="poll-creation.php">Créer un sondage</a>
                                    </div>
                                </div>
                                </div>
                        </div>

                        <?php                   
                        if (isset($_SESSION['pseudo'])) { // si quelqu'un est connecté                            
                            // Affichage de titre de chaque sondage de l'utilisateur connecté
                            $req_user_surv = $mysqli->query("SELECT * FROM surveys WHERE `owner` = $_SESSION[id]");
                            $req_user_surv->data_seek(0); // sous forme de tableau pour recup les données par colonnes
                            while ($row = $req_user_surv->fetch_assoc()) {
                                $surv_id = array(); // je créer un tableau qui récupère tout nos id de sondage
                                if ($row['title'] == "") // si le sondage n'a pas été nommé
                                {
                                    $row['title'] = "sondage sans nom"; // alors je le nomme "sans nom"
                                }
                                array_push($surv_id, $row['id']); // à chaque itération je mets les id à la fin du tableau
                                // print_r(array_values($surv_id)); // fonctionne correctement
                                echo "<h2 style='text-decoration: underline;'>$row[title] - id : $row[id]</h2>";           
                                                    
                                // Affichage des questions de chaque sondages :
                                foreach($surv_id as $surv) { // pour chaque id des sondages
                                    $req_user_quest = $mysqli->query("SELECT * FROM questions WHERE `poll`=$surv");
                                    $req_user_quest->data_seek(0);
                                    while ($row = $req_user_quest->fetch_assoc()) {
                                        $quest_id = array(); // je créer un tableau qui récupère tout nos id des questions / également se réinitialise
                                        if ($row['question'] == "") // si la question n'a pas été nommé
                                        {
                                            $row['question'] = "question sans nom"; // alors je la nomme "sans nom"
                                        }
                                        array_push($quest_id, $row['id']); // à chaque itération je mets les id à la fin du tableau
                                        echo "<h5>$row[question]</h5>";
                                    
                                        foreach($quest_id as $quest) { // pour chaque id des questions
                                            $req_user_answ = $mysqli->query("SELECT * FROM answers WHERE `choice`=$quest");
                                            $req_user_answ->data_seek(0);
                                            while ($row = $req_user_answ->fetch_assoc()){
                                                if ($row['answer'] == "") // si la question n'a pas été nommé
                                        {
                                            $row['answer'] = "réponse sans nom"; // alors je la nomme "sans nom"
                                        }
                                                echo "<p>- $row[answer]</p>";
                                            }                    
                                        } 
                                    }
                                }  
                            }
                        /*
                        echo "les id des questions : ";
                        foreach($quest_id as $quest) {
                            echo $quest;
                        }
                        echo "<br> le nombre d'id cumulée : ";
                        echo count($quest_id);
                        */
                        } else {
                            echo "Vous devez vous connecter pour afficher vos sondages";
                        }
                        ?>
                    </div>
                </div>
        </div>
    </div>
<script type="text/javascript" src="./assets/scripts/main.js"></script></body>
</html>