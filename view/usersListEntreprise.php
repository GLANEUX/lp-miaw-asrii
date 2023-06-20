<!-- Liste et gestion des entreprises -->
<!-- Accessible uniquement pour les Admins -->
<!-- Accessible sur /users/list/entreprise -->
<h1>Les Entreprises</h1>

<div class="contain my-3">
<a  href="<?= URL ?>/users/add/entreprise" class="bg-custom-purple txt-color-black button-font py-2 px-3 rounded">Ajouter un
entreprise</a>
<a href="<?= URL ?>/home" class="see">Retour</a></div>
<div class="container mb-5">

<table class="table">
  <thead class="thead-dark">
    <tr>
      <th>Dénomination sociale</th>
      <th>SIRET</th>
      <th>Numéro</th>
      <th>Adresse</th>
      <th>Adresse mail</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($data['entreprises'] as $entreprises) { ?>
      <tr>
        <td><?= $entreprises['societe'] ?></td>
        <td><?= $entreprises['siret'] ?></td>
        <td><?= $entreprises['numero'] ?></td>
        <td><?= $entreprises['adresse'] . ', '. $entreprises['code_postal'] . ' ' . $entreprises['ville'] ?></td>
        <td><?= $entreprises['email'] ?></td>
        <td>
        <a href="<?= URL ?>/users/edit/entreprise?id=<?= $entreprises['id'] ?>" class="btn btn-primary btn-sm">Modifier</a>

          <a href="<?= URL ?>/users/list/entreprise?id=<?= $entreprises['id'] ?>" class="btn btn-danger btn-sm">Supprimer</a>
          <?php if ($entreprises['confirme'] == 0){ ?>
              <a href="<?= URL ?>/users/list/entreprise/confirme?id=<?= $entreprises['id'] ?>" class="btn btn-primary btn-sm">Confirmer</a>
          <?php } ?>
        </td>
      </tr>
    <?php } ?>
  </tbody>
</table>
</div>


