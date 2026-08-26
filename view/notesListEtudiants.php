<!-- Liste des étudiants -->
<!-- Accessible uniquement pour les Enseignants ou les Admins -->
<!-- Accessible sur /notes -->


<h1>Les etudiants</h1>



<div class="contain my-3">





<a href="<?= URL ?>/home" class="see">Retour</a></div>
  <div class="container mb-5">


  <table class="table">
    <thead class="thead-dark">
      <tr>
        <th>Nom</th>
        <th>Prénom</th>
        <th>Consulter</th>
        <th>Ajouter</th>

      </tr>
    </thead>
    <tbody>
    <?php foreach ($data['etudiants'] as $etudiant) { ?>
        <tr>
        <td><?= e($etudiant['nom']) ?></td>

        <td><?= e($etudiant['prenom']) ?></td>
        <td><a href="<?= URL ?>/notes?id=<?= e($etudiant['id']) ?>" class="btn btn-primary btn-sm">Consulter les notes</a></td>
                <td><a href="<?= URL ?>/notes/add?id=<?= e($etudiant['id']) ?>" class="btn btn-success btn-sm">Ajouter une note</a></td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
</div>