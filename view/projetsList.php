<!-- Liste des projets -->
<!-- Accessible uniquement pour les Etudiants, Entreprises, Enseignants ou les Admins -->
<!-- Accessible sur /projets/list -->

<table class="table">
  <thead class="thead-dark">
    <tr>
      <th>Titre</th>
      <th>Description</th>
      <?php if ($_SESSION['level'] != 'entreprise') {?>
        <th>Entreprise</th>
        <th>Adresse</th>
        <th>Numéro</th>
        <th>Adresse mail</th>
      <?php } if (($_SESSION['level'] == 'entreprise') || ($_SESSION['level'] == 'administrateur')) { ?>
        <th>Actions</th>
      <?php } ?>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($data['projets'] as $projet) { ?>
      <tr>
        <td><?= $projet['titre'] ?></td>
        <td><pre><?= $projet['description'] ?></pre></td>
        <?php if ($_SESSION['level'] != 'entreprise') {?>
          <td><?= $projet['societe'] ?></td>
          <td><?= $projet['adresse'] . ', '. $projet['code_postal'] . ' ' . $projet['ville'] ?></td>
          <td><?= $projet['numero'] ?></td>
          <td><?= $projet['email'] ?></td>
        <?php } if (($_SESSION['level'] == 'entreprise') || ($_SESSION['level'] == 'administrateur')) { ?>
          <td>
            <a href="<?= URL ?>/projets/edit?id=<?= $projet['id'] ?>" class="btn btn-primary btn-sm">Modifier</a>
            <a href="<?= URL ?>/projets/delete?id=<?= $projet['id'] ?>" class="btn btn-danger btn-sm">Supprimer</a>
          </td>
        <?php } ?>
      </tr>
    <?php } ?>
  </tbody>
</table>



<style>header{ display: none;} footer{display: none;}</style>