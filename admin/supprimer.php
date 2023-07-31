<?php
session_start();
require_once("connexion.php");

// Vérifie si l'ID est présent dans l'URL (via la méthode GET) et s'il n'est pas vide
if (isset($_GET["id"]) && !empty($_GET["id"])) {
    $id = strip_tags($_GET["id"]);
    // Utilisation de strip_tags pour supprimer toutes les balises HTML et PHP de l'ID.
    // Cela protège contre les attaques XSS (Cross-Site Scripting) qui pourraient être utilisées pour injecter des scripts malveillants dans votre application.
}

// Prépare une requête SQL pour supprimer une ligne de la table "realisation" avec l'ID correspondant
$sth = $db->prepare("DELETE FROM realisation WHERE id=:id");

// Exécute la requête préparée en fournissant l'ID à supprimer via un tableau associatif
$sth->execute([":id" => $_GET["id"]]);

// Récupère la première ligne résultant de la requête (ce n'est pas nécessaire dans le cas d'une suppression)
$projets = $sth->fetch(PDO::FETCH_ASSOC);

// Redirige vers la page "gestion.php" après avoir effectué la suppression
header("location: gestion.php");

?>