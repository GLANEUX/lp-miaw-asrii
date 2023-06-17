<!-- Liste et gestion des administrateurs -->
<!-- Accessible uniquement pour les Admins -->
<!-- Accessible sur /users/list/administrateur -->
<h1>Les admin</h1>

<div class="contain my-3">

<a  href="<?= URL ?>/users/add/administrateur" class="bg-custom-purple txt-color-black button-font py-2 px-3 rounded">Ajouter un
administrateur</a>
<a class="see"> -</a>
<a href="<?= URL ?>/home" class="see">Retour</a></div>
<div class="container mb-5">

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
</div>



