<!-- Liste et gestion des administrateurs -->
<!-- Accessible uniquement pour les Admins -->
<!-- Accessible sur /users/list/administrateur -->

<table class="table">
  <thead class="thead-dark">
    <tr>
      <th>Nom</th>
      <th>Prénom</th>
      <th>Adresse mail</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($data['administrateurs'] as $administrateurs) { ?>
      <tr>
        <td><?= $administrateurs['nom'] ?></td>
        <td><?= $administrateurs['prenom'] ?></td>
        <td><?= $administrateurs['email'] ?></td>
        <td>
          <a href="<?= URL ?>/users/list/administrateur?id=<?= $administrateurs['id'] ?>" class="btn btn-danger btn-sm">Supprimer</a>
        </td>
      </tr>
    <?php } ?>
  </tbody>
</table>



<style>header{ display: none;} footer{display: none;}</style>