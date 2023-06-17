<!-- Affiche les supports de cours -->
<!-- Accessible uniquement pour les Etudiants, Enseignants ou les Admins -->
<!-- Accessible sur /supports -->
<h1>Les supports de cours</h1>

<div class="contain my-3" style="max-width: 50%!important;">

<?php if ( ($_SESSION['level'] == 'enseignant') || ($_SESSION['level'] == 'administrateur')) { ?>

<a href="<?= URL ?>/supports/add" class="bg-custom-purple txt-color-black button-font py-2 px-3 rounded">Ajouter un
  support</a>
<a class="see"> -</a>
<?php } ?>
<a href="<?= URL ?>/home" class="see">Retour</a></div>
<div class="container mb-5" style="max-width: 50%!important;">

<table class="table">
          <thead class="thead-dark">
            <tr>
              <th>Matière</th>
             
              <th>titre</th>
              <th>visuel</th>
              <?php if ( ($_SESSION['level'] == 'enseignant') || ($_SESSION['level'] == 'administrateur')) { ?>
               <th>Actions</th>
                <?php } ?>
            </tr>
          </thead>
          <tbody>
          <?php foreach ($data['sup'] as $sup) { ?>
              <tr>
                <td>
                <?= $sup['matiere'] ?>
                </td>
           
                <td>
                <a target="_blank" href="<?= URL . $data['url'] ?>"> <?= $sup['titre'] ?> </a>
                </td>
                <td>

<iframe src="<?= URL . $data['url']; ?>" ></iframe>
</td>
<?php if ( ($_SESSION['level'] == 'enseignant') || ($_SESSION['level'] == 'administrateur')) { ?>
                 <td>  
            <a href="<?= URL ?>/supports/delete?id=<?= $sup['id'] ?>" class="btn btn-danger btn-sm"> Supprimer </a>
            
                 </td>
                <?php } ?>
              </tr>
            <?php } ?>
          </tbody>
        </table>
</div>