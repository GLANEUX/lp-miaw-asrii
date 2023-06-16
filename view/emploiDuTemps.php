<!-- Affiche les emplois du temps -->
<!-- Accessible uniquement pour les Etudiants, Entreprises, Enseignants ou les Admins -->
<!-- Accessible sur /emplois-du-temps -->


<h1>Les emplois-du-temps</h1>

<div class="contain my-3" style="max-width: 50%!important;">

<?php if ( ($_SESSION['level'] == 'enseignant') || ($_SESSION['level'] == 'administrateur')) { ?>

<a href="<?= URL ?>/emplois-du-temps/add" class="bg-custom-purple txt-color-black button-font py-2 px-3 rounded">Ajouter un
  EDT</a>
<a class="see"> -</a>
<?php } ?>
<a href="<?= URL ?>/home" class="see">Retour</a></div>
<div class="container mb-5" style="max-width: 50%!important;">

<table class="table">
          <thead class="thead-dark">
            <tr>
             
              <th>Date</th>
              <th>visuel</th>
              <?php if ( ($_SESSION['level'] == 'enseignant') || ($_SESSION['level'] == 'administrateur')) { ?>
               <th>Actions</th>
                <?php } ?>
            </tr>
          </thead>
          <tbody>
          <?php foreach ($data['edt'] as $edt) { ?>
              <tr>
              <td>
                <a target="_blank" href="<?=  URL . $data['url'] ?>"> <?= $edt['date'] ?> </a>
                </td>
                <td>

                <iframe src="<?= URL . $data['url']; ?>" ></iframe>
</td>
<?php if ( ($_SESSION['level'] == 'enseignant') || ($_SESSION['level'] == 'administrateur')) { ?>
                 <td>  
            <a href="<?= URL ?>/emplois-du-temps/delete?id=<?= $edt['id'] ?>" class="btn btn-danger btn-sm"> Supprimer </a>
                 </td>
                <?php } ?>
              </tr>
            <?php } ?>
          </tbody>
        </table>
</div>