<?php
session_start();
require_once("connexion.php");

// Vérifie si l'ID est présent dans l'URL (via la méthode GET) et s'il n'est pas vide
if (isset($_GET["id"]) && !empty($_GET["id"])) {
    $id = strip_tags($_GET["id"]); // Récupère l'ID depuis l'URL et le protège contre les attaques XSS
    // À ce stade, $id contient l'ID de la réalisation que l'utilisateur souhaite supprimer
}

/* Prépare une requête SQL pour supprimer l'entrée de la table "messagerie" qui a l'ID correspondant
 * Cette requête utilise une clause WHERE pour cibler l'entrée spécifique */
$sth = $db->prepare("DELETE FROM messagerie WHERE id=:id");
$sth->execute([":id" => $_GET["id"]]); // Exécute la requête préparée en remplaçant :id par la valeur de $_GET["id"]

// Redirige vers la page "messagerie.php" après avoir effectué la suppression
header("location:messagerie.php");
?>