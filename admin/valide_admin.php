<?php
session_start();
require("connexion.php");

// Fonction pour nettoyer les données saisies par l'utilisateur
function test_input($data) {
    $data = trim($data); // Supprime les espaces au début et à la fin
    $data = stripslashes($data); // Supprime les backslashes (\)
    $data = htmlspecialchars($data); // Convertit les caractères spéciaux en entités HTML
    return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = test_input($_POST["username"]); // Nettoie le nom d'utilisateur saisi
    $password = $_POST["password"]; // Le mot de passe n'est pas nettoyé ici
    // Remarque : Le mot de passe ne doit pas être nettoyé, car nous devons le vérifier avec le mot de passe haché stocké dans la base de données.

    // Supposons que $db est l'objet de connexion PDO

    // Prépare une requête SQL pour sélectionner toutes les colonnes de la table "admin"
    $stmt = $db->prepare("SELECT * FROM admin");

    // Exécute la requête préparée
    $stmt->execute();

    // Récupère toutes les lignes retournées par la requête sous forme d'un tableau associatif
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Parcourt chaque utilisateur récupéré de la base de données
    foreach ($users as $user) {
        // Vérifie si le nom d'utilisateur et le mot de passe soumis correspondent aux enregistrements de la base de données en utilisant password_verify()
        if (($user['username'] == $username) && password_verify($password, $user['password'])) {
            // Si les informations d'identification sont valides, définissez la variable de session $_SESSION["login"] avec le nom d'utilisateur
            $_SESSION["login"] = $user['username'];

            // Redirige l'utilisateur vers "acceuil.php"
            header("Location: acceuil.php");
        } else {
            // Si les informations d'identification sont invalides, affiche un message d'alerte en utilisant JavaScript
            echo "<script language='javascript'>";
            echo "alert('Mot de passe incorrect')";
            echo "</script>";
        }
    }
}
