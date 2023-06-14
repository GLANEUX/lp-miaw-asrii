<!-- Liste des offres d'alternance -->
<!-- Accessible uniquement pour les Etudiants, Entreprises, Enseignants ou les Admins -->
<!-- Accessible sur /offres -->
<h1>Les Offres d'alternance</h1> 
<div class="contain my-3">
<a href="<?= URL ?>/projets/add" class="bg-custom-purple txt-color-black button-font py-2 px-3 rounded">Ajouter un
  Projet</a>
<a class="see"> -</a>
<a href="<?= URL ?>/home" class="see">Retour</a></div>
<div class="container mb-5">
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
  <?php foreach ($data['alternances'] as $alternances) { ?>
      <tr>
        <td><?= $alternances['poste'] ?></td>
        <td><pre><?= $alternances['description'] ?></pre></td>
        <?php if ($_SESSION['level'] != 'entreprise') {?>
          <td><?= $alternances['societe'] ?> </td>
          <td> <?= $alternances['adresse'] . ', '. $alternances['code_postal'] . ' ' . $alternances['ville'] ?></td>
          <td><?= $alternances['numero'] ?></td>
          <td><?= $alternances['email'] ?></td>
          <?php } if ( ($_SESSION['level'] == 'entreprise') || ($_SESSION['level'] == 'administrateur')) { ?>
          <td>
            <a href="<?= URL ?>/offres/edit?id=<?=$alternances['id']?>" class="btn btn-primary btn-sm">Modifier</a>
            <a href="<?= URL ?>/offres/delete?id=<?=$alternances['id']?>" class="btn btn-danger btn-sm">Supprimer</a>
          </td>
        <?php } ?>
      </tr>
    <?php } ?>
  </tbody>
</table>
  </div>



