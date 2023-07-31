<?php
session_start(); // Démarre la session, permettant d'accéder aux variables de session

require_once("connexion.php"); // Inclut le fichier de connexion à la base de données

// Vérifie si le formulaire a été soumis via la méthode POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Vérifie si toutes les données nécessaires ont été envoyées via le formulaire
    if (
        isset($_POST["titre"]) && !empty($_POST["titre"])
        && isset($_POST["paragraphe"]) && !empty($_POST["paragraphe"])
        && isset($_FILES["image"]["name"]) && !empty($_FILES["image"]["name"])
        && isset($_POST["etat"]) && !empty($_POST["etat"])
        && isset($_POST["lien_github"]) && !empty($_POST["lien_github"])
    ) {
        // Récupère les valeurs du formulaire et protège contre les attaques XSS
        $titre = strip_tags($_POST["titre"]);
        $paragraphe = strip_tags($_POST["paragraphe"]);
        $etat = strip_tags($_POST["etat"]);
        $lien_github = strip_tags($_POST["lien_github"]);

        // Vérifie si l'upload de l'image s'est bien déroulé
        if ($_FILES["image"]["error"] === UPLOAD_ERR_OK) {
            $targetDirectory = "./../assets/img/"; // Changez cela avec le chemin vers votre dossier d'images
            $targetFile = $targetDirectory . basename($_FILES["image"]["name"]);

            // Déplace l'image téléchargée vers le dossier cible
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
                // L'upload a réussi, maintenant insérez les données dans la base de données
                $sth = $db->prepare("INSERT INTO realisation (titre, paragraphe, image, etat, lien_github) VALUES (:titre, :paragraphe, :image, :etat, :lien_github)");
                $sth->bindValue(":titre", $titre);
                $sth->bindValue(":paragraphe", $paragraphe);
                $sth->bindValue(":image", $_FILES["image"]["name"]);
                $sth->bindValue(":etat", $etat);
                $sth->bindValue(":lien_github", $lien_github);
                $sth->execute();

                // Redirige vers la page d'accueil après l'enregistrement
                header("Location: acceuil.php");
                exit;
            } else {
                echo "Une erreur s'est produite lors de l'upload de l'image.";
            }
        } else {
            echo "Erreur lors de l'upload de l'image : " . $_FILES["image"]["error"];
        }
    } else {
        echo "Veuillez remplir tous les champs du formulaire.";
    }
}

include "header.php"; // Inclut le fichier "header.php" pour afficher l'en-tête de la page
?>



<section class="section_form">

<form id="ajout" method="POST" enctype="multipart/form-data">
    <h1>Ajouter une réalisation</h1>
        <div class="form-group">
            <label class="form-label" for="titre">Titre</label>
            <input class="form-control" type="text" name="titre" id="titre" required>
        </div>

        <div class="form-group">
            <label class="form-label" for="paragraphe">Paragraphe</label>
            <input class="form-control" type="text" name="paragraphe" id="paragraphe" required>
        </div>

        <div class="form-group">
            <label class="form-label" for="image">Image</label>
            <input class="form-control" type="file" id="image" name="image" required>
        </div>

        <div class="form-group">
            <label class="form-label">État</label><br> <!--bouton pour donner la valeur visible ou invisible dans la base de données-->
            <input type="radio" name="etat" value="visible" required> <label for="etat">Visible</label><br>
            <input type="radio" name="etat" value="invisible" required> <label for="etat">Invisible</label>
        </div>

        <div class="form-group">
            <label class="form-label" for="lien_github">Lien GitHub</label>
            <input class="form-control" type="text" name="lien_github" id="lien_github" required>
        </div>

        <button type="submit" class="btn-submit"><i class="fa fa-paper-plane" aria-hidden="true"></i> Enregistrer</button>
    </form>

<section>