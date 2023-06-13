<!-- Liste et gestion des étudiants -->
<!-- Accessible uniquement pour les Admins -->
<!-- Accessible sur /users/list/etudiant -->

<table class="table">
  <thead class="thead-dark">
    <tr>
      <th>Nom</th>
      <th>Prénom</th>
      <th>Date de naissance</th>
      <th>Adresse</th>
      <th>Adresse mail</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($data['etudiants'] as $etudiants) { ?>
      <tr>
        <td><?= $etudiants['nom'] ?></td>
        <td><?= $etudiants['prenom'] ?></td>
        <td><?= $etudiants['date_de_naissance'] ?></td>
        <td><?= $etudiants['adresse'] . ', '. $etudiants['code_postal'] . ' ' . $etudiants['ville'] ?></td>
        <td><?= $etudiants['email'] ?></td>
        <td>
          <a href="<?= URL ?>/users/list/etudiant?id=<?= $etudiants['id'] ?>" class="btn btn-danger btn-sm">Supprimer</a>
        </td>
      </tr>
    <?php } ?>
  </tbody>
</table>



<style>header{ display: none;} footer{display: none;}</style>