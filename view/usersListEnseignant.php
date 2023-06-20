<!-- Liste et gestion des enseignants -->
<!-- Accessible uniquement pour les Admins -->
<!-- Accessible sur /users/list/enseignant -->
<h1>Les Enseignants</h1>

<div class="contain my-3">
<a  href="<?= URL ?>/users/add/enseignant" class="bg-custom-purple txt-color-black button-font py-2 px-3 rounded">Ajouter un
enseignant</a>
<a href="<?= URL ?>/home" class="see">Retour</a></div>
<div class="container mb-5">

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
        <a href="<?= URL ?>/users/edit/enseignant?id=<?= $enseignants['id'] ?>" class="btn btn-primary btn-sm">Modifier</a>
          <a href="<?= URL ?>/users/list/enseignant?id=<?= $enseignants['id'] ?>" class="btn btn-danger btn-sm">Supprimer</a>
        </td>
      </tr>
    <?php } ?>
  </tbody>
</table>



</div>
