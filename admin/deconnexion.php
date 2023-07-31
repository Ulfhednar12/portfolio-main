<?php
session_start(); // Démarre la session, permettant d'accéder aux variables de session

$_SESSION = NULL; // Réinitialise la variable de session $_SESSION en la définissant comme NULL

session_destroy(); // Détruit toutes les données enregistrées dans la session

header("location:login.php"); // Redirige l'utilisateur vers la page "login.php" après avoir détruit la session
?>