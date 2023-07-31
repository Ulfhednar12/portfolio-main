<?php
session_start();
include "header.php"; // Inclut le fichier "header.php" pour afficher l'en-tête de la page
require "connexion.php"; // Inclut le fichier de connexion à la base de données

// Requête SQL pour récupérer toutes les entrées de la table "messagerie" triées par ordre décroissant de l'ID
$sql = "SELECT * FROM messagerie ORDER BY id DESC";
$query = $db->prepare($sql);
$query->execute();

$resultat = $query->fetchAll(); // Récupère toutes les lignes de résultat dans le tableau associatif $resultat
?>

<body>
    <br><br>
    <h1>Tous les messages</h1><br>
    <!-- Affichage du tableau des messages -->
    <table class="table table-striped">
        <thead>
            <tr>
                <th class="text-center" scope="col">Date</th>
                <th class="text-center" scope="col">Nom</th>
                <th class="text-center" scope="col">Email</th>
                <th class="text-center" scope="col">Téléphone</th>
                <th class="text-center" scope="col">Aperçu</th>
                <th class="text-center" scope="col">Supprimer</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($resultat as $valeur) { ?>
            <!-- Boucle pour afficher chaque message dans une ligne du tableau -->
            <tr>
            <td class="text-center"><?= date('d/m/Y', strtotime($valeur["date"])) ?></td>
                <th class="text-center" scope="row"><?= $valeur['nom'] ?></th>
                <td class="text-center"><?= $valeur["email"] ?></td>
                <td class="text-center"><?= $valeur["telephone"] ?></td>
                <td class="text-center">
                    <!-- Lien vers la page "page_message.php" avec l'ID du message dans l'URL -->
                    <a href="page_message.php?id=<?= $valeur["id"] ?>" title="Aperçu">
                        <i class='bx bx-search-alt-2'></i>
                    </a>
                </td>
                <td class="text-center">
                    <!-- Lien pour supprimer le message avec confirmation -->
                    <a href="delete.php?id=<?= $valeur['id'] ?>" onclick="return confirmation()">
                        <i class='bx bxs-eraser'></i>
                    </a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>

    <script>
        // Fonction JavaScript pour confirmer une suppression
        function confirmation() {
            return confirm('Voulez-vous vraiment supprimer ?');
        }
    </script>
</body>