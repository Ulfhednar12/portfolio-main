<?php
session_start();
include "header.php"; // Inclut le fichier "header.php" pour afficher l'en-tête de la page
require "connexion.php"; // Inclut le fichier de connexion à la base de données

// Requête SQL pour récupérer toutes les entrées de la table "realisation" triées par ordre décroissant de l'ID
$sql = "SELECT * FROM realisation ORDER BY id DESC";
$query = $db->prepare($sql);

$query->execute();

$resultat = $query->fetchAll(); // Récupère toutes les lignes de résultat dans le tableau associatif $resultat
?>

<body>
<br><br>
<h1>Gestion des réalisations</h1>
  <!-- Bouton pour ajouter une nouvelle réalisation -->
  <button type="button" class="btn-submit" id="btn-submit2"><a href="ajout.php">Ajouter une réalisation</a></button>
  <table class="table table-striped">
    <thead>
      <tr>
        <th class="text-center" scope="col">Titre</th>
        <th class="text-center" scope="col">Description</th>
        <th class="text-center" scope="col">Image</th>
        <th class="text-center" scope="col">Lien Github</th>
        <th class="text-center" scope="col">Etat</th>
        <th class="text-center" scope="col">Modifier</th>
        <th class="text-center" scope="col">Supprimer</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($resultat as $valeur) { ?>
        <!-- Boucle pour afficher chaque réalisation dans une ligne du tableau -->
        <tr>
          <th class="text-center" scope="row"><?= $valeur['titre'] ?></th>
          <td class="text-center"><?= $valeur['paragraphe'] ?></td>
          <td class="text-center image"><img src="./../assets/img/<?= $valeur['image'] ?>"></td>
          <td class="text-center"><?= $valeur["lien_github"] ?></td>
          <td class="text-center"><?= $valeur["etat"] ?></td>

          <!-- Lien vers la page "modifier.php" avec l'ID de la réalisation dans l'URL pour la modification -->
          <td class="text-center"> <a href="modifier.php?id=<?= $valeur['id'] ?>"><i class='bx bxs-edit'></i></a></td>
          <!-- Lien pour supprimer la réalisation avec confirmation -->
          <td class="text-center"> <a href="supprimer.php?id=<?= $valeur['id'] ?>" onclick="return confirmation()"><i class='bx bxs-eraser'></i></a></td>
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