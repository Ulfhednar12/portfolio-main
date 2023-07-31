<?php
session_start(); // Démarre la session, permettant d'accéder aux variables de session

include "header.php"; // Inclut le fichier "header.php" pour afficher l'en-tête de la page

require "connexion.php"; // Inclut le fichier de connexion à la base de données

// Requête pour sélectionner les dernières réalisations publiées
$sql = "SELECT * FROM realisation ORDER BY id DESC LIMIT 10";
$query = $db->prepare($sql);
$query->execute();
$resultat = $query->fetchAll();

// Requête pour sélectionner les derniers messages reçus
$sql1 = "SELECT * FROM messagerie ORDER BY id DESC LIMIT 5";
$query = $db->prepare($sql1);
$query->execute();
$resultat2 = $query->fetchAll();
?>

<body>
  <br>
  <h1>Dernières réalisations publiées</h1>
  <section id="card_realisation">

    <?php foreach ($resultat as $valeur) { ?>
      <!-- Affichage des dernières réalisations publiées sous forme de cartes -->
      <div class="card" style="width: 18rem; margin: 20px;">
        <img src="./../assets/img/<?= $valeur['image'] ?>" style="width: 18rem; height: 15rem" class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title"><?= $valeur['titre'] ?></h5>
          <p class="card-text"><?= $valeur['paragraphe'] ?></p>
          <p class="card-text"><?= $valeur['etat'] ?></p>
          <a href="modifier.php?id=<?= $valeur['id'] ?>" class="btn btn-primary">Modifier</a>
        </div>
      </div>
    <?php } ?>
  </section>
  <br>
  <h1>Derniers messages reçus</h1><br>
  <table class="table table-striped">
    <thead>
      <tr>
      <th class="text-center" scope="col">Date</th> 
        <th class="text-center" scope="col">Nom</th> <!-- col row dans les class c'est le framework bootstrap qui met en forme automatiquement -->
        <th class="text-center" scope="col">Email</th>
        <th class="text-center" scope="col">Telephone</th>
        <th class="text-center" scope="col">Aperçu</th>
        <th class="text-center" scope="col">Supprimer</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($resultat2 as $valeurs) { ?>
        <!-- boucle pour afficher chaque donnée de la table messagerie -->
        <tr>
        <td class="text-center"><?= date('d/m/Y', strtotime($valeurs["date"])) ?></td>
          <th class="text-center" scope="row"><?= $valeurs['nom'] ?></th>
          <td class="text-center"><?= $valeurs["email"] ?></td>
          <td class="text-center"><?= $valeurs["telephone"] ?></td>
          <td class="text-center"><a href="page_message.php?id=<?= $valeurs["id"] ?>" title="Aperçu"><i class='bx bx-search-alt-2' ></i></a></td>
          <td class="text-center"> <a href="delete.php?id=<?= $valeurs['id'] ?>" onclick="return confirmation()"><i class='bx bxs-eraser'></i></a></td>
        </tr>
      <?php } ?>

    </tbody>
  </table>

  <script>
    // JS pour confirmer une suppression
    function confirmation() {
      return confirm('Voulez-vous vraiment supprimer ?');
    }
  </script>
</body>