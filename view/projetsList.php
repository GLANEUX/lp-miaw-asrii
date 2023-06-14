<!-- Liste des projets -->
<!-- Accessible uniquement pour les Etudiants, Entreprises, Enseignants ou les Admins -->
<!-- Accessible sur /projets/list -->

<h1>Les Projet Tuteuré</h1>


<?php if ($_SESSION['level'] != 'entreprise') {?>

<div class="contain my-3">
<?php } else{?>
  <div class="contain my-3" style="max-width: 70%!important;">

  <?php }?>
<?php           if (($_SESSION['level'] == 'entreprise') || ($_SESSION['level'] == 'administrateur')) { ?>

<a href="<?= URL ?>/projets/add" class="bg-custom-purple txt-color-black button-font py-2 px-3 rounded">Ajouter un
  Projet</a>
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
        <?php if ($_SESSION['level'] != 'entreprise') { ?>
          <th>Entreprise</th>
          <th>Adresse</th>
          <th>Numéro</th>
          <th>Adresse mail</th>
        <?php }
        if (($_SESSION['level'] == 'entreprise') || ($_SESSION['level'] == 'administrateur')) { ?>
          <th>Actions</th>
        <?php } ?>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($data['projets'] as $projet) { ?>
        <tr>
          <td>
            <?= $projet['titre'] ?>
          </td>
          <td>
            <pre><?= $projet['description'] ?></pre>
          </td>
          <?php if ($_SESSION['level'] != 'entreprise') { ?>
            <td>
              <?= $projet['societe'] ?>
            </td>
            <td>
              <?= $projet['adresse'] . ', ' . $projet['code_postal'] . ' ' . $projet['ville'] ?>
            </td>
            <td>
              <?= $projet['numero'] ?>
            </td>
            <td>
              <?= $projet['email'] ?>
            </td>
          <?php }
          if (($_SESSION['level'] == 'entreprise') || ($_SESSION['level'] == 'administrateur')) { ?>
            <td>
              <a href="<?= URL ?>/projets/edit?id=<?= $projet['id'] ?>" class="btn btn-primary btn-sm">Modifier</a>
              <a href="<?= URL ?>/projets/delete?id=<?= $projet['id'] ?>" class="btn btn-danger btn-sm">Supprimer</a>
            </td>
          <?php } ?>
        </tr>
      <?php } ?>
    </tbody>
  </table>
</div>