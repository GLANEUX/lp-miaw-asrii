<!-- Liste et gestion des enseignants -->
<!-- Accessible uniquement pour les Admins -->
<!-- Accessible sur /users/list/enseignant -->

<table class="table">
  <thead class="thead-dark">
    <tr>
      <th>Nom</th>
      <th>Prénom</th>
      <th>Adresse</th>
      <th>Adresse mail</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($data['enseignants'] as $enseignants) { ?>
      <tr>
        <td><?= $enseignants['nom'] ?></td>
        <td><?= $enseignants['prenom'] ?></td>
        <td><?= $enseignants['adresse'] . ', '. $enseignants['code_postal'] . ' ' . $enseignants['ville'] ?></td>
        <td><?= $enseignants['email'] ?></td>
        <td>
          <a href="<?= URL ?>/users/list/enseignant?id=<?= $enseignants['id'] ?>" class="btn btn-danger btn-sm">Supprimer</a>
        </td>
      </tr>
    <?php } ?>
  </tbody>
</table>



<style>header{ display: none;} footer{display: none;}</style>