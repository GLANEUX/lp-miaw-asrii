<!-- Liste des offres d'alternance -->
<!-- Accessible uniquement pour les Etudiants, Entreprises, Enseignants ou les Admins -->
<!-- Accessible sur /offres -->
<h1>Les Offres d'alternance</h1> 


<?php if ($_SESSION['level'] != 'entreprise') {?>

<div class="contain my-3">
<?php } else{?>
  <div class="contain my-3" style="max-width: 70%!important;">

  <?php }?>

<?php           if (($_SESSION['level'] == 'entreprise') || ($_SESSION['level'] == 'administrateur')) { ?>


<a href="<?= URL ?>/offres/add" class="bg-custom-purple txt-color-black button-font py-2 px-3 rounded">Ajouter une Offre</a>
<a class="see"> -</a>
<?php } ?>

<a href="<?= URL ?>/home" class="see">Retour</a></div>




<?php if ($_SESSION['level'] != 'entreprise') {?>
  <div class="container mb-5">

  <?php } else{?>
    <div class="container mb-5" style="max-width: 70%!important;">

<?php }?>
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
        <td><?= e($alternances['poste']) ?></td>
        <td><pre><?= e($alternances['description']) ?></pre></td>
        <?php if ($_SESSION['level'] != 'entreprise') {?>
          <td><?= e($alternances['societe']) ?> </td>
          <td> <?= e($alternances['adresse'] . ', '. $alternances['code_postal'] . ' ' . $alternances['ville']) ?></td>
          <td><?= e($alternances['numero']) ?></td>
          <td><?= e($alternances['email']) ?></td>
          <?php } if ( ($_SESSION['level'] == 'entreprise') || ($_SESSION['level'] == 'administrateur')) { ?>
          <td>
            <a href="<?= URL ?>/offres/edit?id=<?= e($alternances['id']) ?>" class="btn btn-primary btn-sm">Modifier</a>
            <a href="<?= URL ?>/offres/delete?id=<?= e($alternances['id']) ?>" class="btn btn-danger btn-sm">Supprimer</a>
          </td>
        <?php } ?>
      </tr>
    <?php } ?>
  </tbody>
</table>
  </div>



