<?php
session_start();
// Protège page admin
// if(!empty($_SESSION['login'])) {
// }

require_once("connexion.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Vérifie si toutes les données nécessaires ont été envoyées via la méthode POST
    if (
        isset($_POST["titre"]) && !empty($_POST["titre"]) &&
        isset($_POST["paragraphe"]) && !empty($_POST["paragraphe"]) &&
        isset($_POST["etat"]) && !empty($_POST["etat"]) &&
        isset($_POST["lien_github"]) && !empty($_POST["lien_github"])
    ) {
        $id = strip_tags($_GET["id"]); // Récupère l'ID depuis l'URL (via la méthode GET) et le protège contre les attaques XSS
        $titre = strip_tags($_POST["titre"]); // Récupère le titre depuis la saisie du formulaire et le protège contre les attaques XSS
        $paragraphe = strip_tags($_POST["paragraphe"]); // Récupère le paragraphe depuis la saisie du formulaire et le protège contre les attaques XSS
        $etat = strip_tags($_POST["etat"]); // Récupère l'état depuis la saisie du formulaire et le protège contre les attaques XSS
        $lien_github = strip_tags($_POST["lien_github"]); // Récupère le lien GitHub depuis la saisie du formulaire et le protège contre les attaques XSS

        // Vérifie si l'upload de l'image s'est bien déroulé, mais seulement si une nouvelle image a été sélectionnée
        if (isset($_FILES["image"]["name"]) && !empty($_FILES["image"]["name"])) {
            if ($_FILES["image"]["error"] === UPLOAD_ERR_OK) {
                $targetDirectory = "./../assets/img/"; // Changez cela avec le chemin vers votre dossier d'images
                $targetFile = $targetDirectory . basename($_FILES["image"]["name"]);

                // Déplace l'image téléchargée vers le dossier cible
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
                    // L'upload a réussi, maintenant insérez les données dans la base de données
                    $requete = "UPDATE realisation SET titre=:titre, paragraphe=:paragraphe, etat=:etat, lien_github=:lien_github, image=:image WHERE id=:id";
                    $sth = $db->prepare($requete);
                    $sth->bindValue(":id", $id, PDO::PARAM_INT);
                    $sth->bindValue(":titre", $titre, PDO::PARAM_STR);
                    $sth->bindValue(":paragraphe", $paragraphe, PDO::PARAM_STR);
                    $sth->bindValue(":etat", $etat, PDO::PARAM_STR);
                    $sth->bindValue(":lien_github", $lien_github, PDO::PARAM_STR);
                    $sth->bindValue(":image", $_FILES["image"]["name"], PDO::PARAM_STR);
                    $sth->execute();

                    // Redirige vers la page de gestion après l'enregistrement
                    header("Location: gestion.php");
                    exit;
                } else {
                    echo "Une erreur s'est produite lors de l'upload de l'image.";
                }
            } else {
                echo "Erreur lors de l'upload de l'image : " . $_FILES["image"]["error"];
            }
        } else {
            // Si aucune nouvelle image n'a été sélectionnée, met à jour la base de données sans modifier l'image
            $requete = "UPDATE realisation SET titre=:titre, paragraphe=:paragraphe, etat=:etat, lien_github=:lien_github WHERE id=:id";
            $sth = $db->prepare($requete);
            $sth->bindValue(":id", $id, PDO::PARAM_INT);
            $sth->bindValue(":titre", $titre, PDO::PARAM_STR);
            $sth->bindValue(":paragraphe", $paragraphe, PDO::PARAM_STR);
            $sth->bindValue(":etat", $etat, PDO::PARAM_STR);
            $sth->bindValue(":lien_github", $lien_github, PDO::PARAM_STR);
            $sth->execute();

            // Redirige vers la page de gestion après l'enregistrement
            header("Location: gestion.php");
            exit;
        }
    } else {
        echo "Vous n'avez pas rempli correctement tous les champs.";
    }
}

if (isset($_GET["id"]) && !empty($_GET["id"])) {
    // Vérifie si l'ID est présent dans l'URL (via la méthode GET) et s'il n'est pas vide
    require_once("connexion.php");
    $id = strip_tags($_GET["id"]); // Récupère l'ID depuis l'URL (via la méthode GET) et le protège contre les attaques XSS

    $sth = "SELECT * FROM realisation WHERE id=:id";
    $sth = $db->prepare($sth);
    $sth->bindValue(":id", $id, PDO::PARAM_INT);
    $sth->execute();
    $resultat = $sth->fetch();

    if (!$resultat) {
        // Redirige vers la page de gestion si aucun résultat n'est trouvé avec l'ID donné
        header("Location: gestion.php");
    }

    $visible = $resultat["etat"] == "visible" ? "checked" : "";
    $invisible = $resultat["etat"] == "invisible" ? "checked" : "";
} else {
    // Redirige vers la page de gestion si l'ID n'est pas présent dans l'URL ou s'il est vide
    header("Location: gestion.php");
}

include "header.php"; // Inclut le fichier "header.php" pour afficher l'en-tête de la page
?>


<section class="section_form">


    <form id="ajout" method="POST" enctype="multipart/form-data">
        <h1>Modifier</h1>
         <div class="form-group">
            <label class="form-label" for="titre">titre</label>
            <input class="form-control" type="text" name="titre" id="titre" value="<?= $resultat["titre"] ?>" required size=50>  <!-- required= indique qu'il faut renseigner obligatoirement les champs -->
        </div>
         <div class="form-group">
            <label class="form-label" for="paragraphe">paragraphe</label>
            <input class="form-control" type="text" name="paragraphe" id="paragraphe" value="<?= $resultat["paragraphe"] ?>" required size=50>  <!-- required= indique qu'il faut renseigner obligatoirement les champs -->
        </div>


        <label class="form-label" for="image">Image</label>
        <img src="./../assets/img/<?= $resultat["image"] ?>" style="width: 100px"><br><br>
        
        <input class="form-control" type="file" class="form-control" id="image" name="image" value="<?= $resultat["image"] ?>" /> 
        </div>
   <br>
         <div class="form-group">
            <label class="form-label" for="etat">Etat</label>
            <input type="radio" name="etat" id="etat" value="visible" <?= $visible ?>><label> visible </label>
            <input type="radio" name="etat" id="etat" value="invisible" <?= $invisible ?>> <label>invisible </label>
        </div>
         <div class="form-group">
            <label class="form-label" for="lien_github">Lien lien_github</label>
            <input class="form-control" type="text" name="lien_github" id="paragraphe" value="<?= $resultat["lien_github"] ?>" required size=50>  <!-- required= indique qu'il faut renseigner obligatoirement les champs -->
        </div>
        <button type="submit" class="btn-submit">Enregistrer</button>


    </form>
</section>
</body>

</html>