<!-- Liste des notes d'un étudiant -->
<!-- Accessible uniquement pour les Etudiants, Enseignants ou les Admins -->
<!-- Accessible sur /notes pour les étudiants -->
<!-- Accessible sur /notes?id=id_de_l_etudiant pour les enseignants ou admins (Il est plus simple d'aller sur /notes puis "Consulter les notes") -->

<h1> Test Notes </h1>

<div class="contain my-3" style="max-width: 50%!important;">
<a href="<?= URL ?>/home" class="see">Retour</a></div>
<div class="container mb-5" style="max-width: 50%!important;">

<table class="table">
          <thead class="thead-dark">
            <tr>
              <th>Matière</th>
              <th>libelle</th>
              <th>note</th>
              <th>commentaire</th>
              <?php if ( ($_SESSION['level'] == 'enseignant') || ($_SESSION['level'] == 'administrateur')) { ?>
               <th>Actions</th>
                <?php } ?>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($data['notes'] as $note) { ?>
              <tr>
                <td>
                  <?= e($note['matiere']) ?>
                </td>
                <td>
                  <?= e($note['libelle']) ?>
                </td>
                <td>
                  <?= e($note['note']) ?>
                </td>
                <td>
                  <pre><?= e($note['commentaire']) ?></pre>
                </td>
                <?php if ( ($_SESSION['level'] == 'enseignant') || ($_SESSION['level'] == 'administrateur')) { ?>
                    <td><a href="<?= URL ?>/notes/edit?id=<?= e($note['idnote']) ?>" class="btn btn-primary btn-sm"> Modifier </a> <a href="<?= URL ?>/notes/delete?id=<?= e($note['idnote']) ?>" class="btn btn-danger btn-sm"> Supprimer </a></td>
                <?php } ?>
              </tr>
            <?php } ?>
          </tbody>
        </table>
</div>