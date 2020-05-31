<?php
session_start(); // reprends la session
session_destroy(); // détruit la session
header('location: index.php'); // redirection sur la page d'accueil
?>

<!-- Si connecté alors affiché bouton déconnexion sinon afficher bouton connexion -->