<?php
session_start();
include "header.php";
require "connexion.php";
// Vérifie si l'ID est présent dans l'URL (via la méthode GET) et s'il n'est pas vide
if (isset($_GET["id"]) && !empty($_GET["id"])) {
    $id = strip_tags($_GET["id"]);
    // Utilisation de strip_tags pour supprimer toutes les balises HTML et PHP de l'ID.
    // Cela protège contre les attaques XSS (Cross-Site Scripting) qui pourraient être utilisées pour injecter des scripts malveillants dans votre application.
}
$sth = $db->prepare("SELECT * FROM messagerie WHERE id=:id"); // Prépare une requête SQL pour sélectionner toutes les colonnes de la table "messagerie"
$sth->execute(array(":id" => $id)); // Exécute la requête préparée avec l'ID récupéré via $_GET
$message = $sth->fetch(PDO::FETCH_ASSOC); // Récupère une seule ligne résultant de la requête sous forme d'un tableau associatif
?>
<div class="retour">
    <a href="messagerie.php"><i class='bx bxs-left-arrow-circle' style="font-size: 25px;"></i> retour à la messagerie</a>
</div>
<section class="section_form">
    <div id="message">
        <?php
        // Vérifie si $message est défini (si la requête a renvoyé un résultat)
        if ($message) {
        ?>
            <h5>Mail reçu <?= date('d/m/Y', strtotime($message["date"])) ?></h5><br><br>
            <div class="contenu">
                <!-- Affiche les informations du message récupéré -->
                <p>Nom : <?= $message["nom"] ?></p>
                <p>Prénom : <?= $message["prenom"] ?></p>
                <p>Téléphone : <?= $message["telephone"] ?></p>
                <p>Email : <?= $message["email"] ?></p>
                <p>Message :<br><br> <?= $message["message"] ?></p><br>
            </div>
            <!-- Bouton pour supprimer le message -->
            <button type="button" class="btn-submit" id="btn-submit">
                <a href="delete.php?id=<?= $message['id'] ?>" style="text-decoration: none;" onclick="return confirmation()">
                    <i class='bx bxs-eraser'></i> Supprimer le message
                </a>
            </button>
        <?php } else {
            // Affiche un message si aucun message n'a été trouvé avec l'ID donné
            echo "<p>Aucun message trouvé avec cet ID.</p>";
        } ?>
    </div>
</section>
<script>
    // Fonction JavaScript pour confirmer une suppression
    function confirmation() {
        return confirm('Voulez-vous vraiment supprimer ?');
    }
</script>

