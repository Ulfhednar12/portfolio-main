<?php

require "connexion.php";

// Fonction pour nettoyer les données saisies par l'utilisateur
function valid_donnees($donnees)
{
    $donnees = trim($donnees); // Supprime les espaces au début et à la fin
    $donnees = stripslashes($donnees); // Supprime les backslashes (\)
    $donnees = htmlspecialchars($donnees); // Convertit les caractères spéciaux en entités HTML
    return $donnees;
}

// Nettoie les données saisies dans les champs du formulaire
$nom = valid_donnees($_POST["nom"]);
$prenom = valid_donnees($_POST["prenom"]);
$email = valid_donnees($_POST["email"]);
$message = valid_donnees($_POST["message"]);
$telephone = valid_donnees($_POST["telephone"]);

// Prépare une requête SQL pour insérer les données saisies dans la table "messagerie"
$sth = $db->prepare("
        INSERT INTO messagerie (nom,prenom,email,message,telephone)
        VALUES(:nom,:prenom,:email,:message,:telephone)");

// Lie les paramètres de la requête avec les valeurs nettoyées
$sth->bindParam(':nom', $_POST['nom']);
$sth->bindParam(':prenom', $_POST['prenom']);
$sth->bindParam(':email', $_POST['email']);
$sth->bindParam(':message', $_POST['message']);
$sth->bindParam(':telephone', $_POST['telephone']);

// Exécute la requête préparée pour insérer les données dans la base de données
$sth->execute();
session_start();
$_SESSION['form_sent'] = true;
header("Location: ./../index.php");
exit();
