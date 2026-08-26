<!-- Liste et gestion des étudiants -->
<!-- Accessible uniquement pour les Admins -->
<!-- Accessible sur /users/list/etudiant -->
<h1>Les etudiants</h1>

<div class="contain my-3">
<a  href="<?= URL ?>/users/add/etudiant" class="bg-custom-purple txt-color-black button-font py-2 px-3 rounded">Ajouter un
etudiant</a>
<a href="<?= URL ?>/home" class="see">Retour</a></div>
<div class="container mb-5">

<table class="table">
  <thead class="thead-dark">
    <tr>
      <th>Nom</th>
      <th>Prénom</th>
      <th>Date de naissance</th>
      <th>Adresse</th>
      <th>Adresse mail</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($data['etudiants'] as $etudiants) { ?>
      <tr>
        <td><?= e($etudiants['nom']) ?></td>
        <td><?= e($etudiants['prenom']) ?></td>
        <td><?= e($etudiants['date_de_naissance']) ?></td>
        <td><?= e($etudiants['adresse'] . ', '. $etudiants['code_postal'] . ' ' . $etudiants['ville']) ?></td>
        <td><?= e($etudiants['email']) ?></td>
        <td>
          <a href="<?= URL ?>/users/list/etudiant?id=<?= e($etudiants['id']) ?>" class="btn btn-danger btn-sm">Supprimer</a>
        </td>
      </tr>
    <?php } ?>
  </tbody>
</table>
</div>

