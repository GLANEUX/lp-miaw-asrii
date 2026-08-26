<!-- Liste et gestion des entreprises -->
<!-- Accessible uniquement pour les Admins -->
<!-- Accessible sur /users/list/entreprise -->
<h1>Les entreprise</h1>

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
        <td><?= e($entreprises['societe']) ?></td>
        <td><?= e($entreprises['siret']) ?></td>
        <td><?= e($entreprises['numero']) ?></td>
        <td><?= e($entreprises['adresse'] . ', '. $entreprises['code_postal'] . ' ' . $entreprises['ville']) ?></td>
        <td><?= e($entreprises['email']) ?></td>
        <td>
          <a href="<?= URL ?>/users/list/entreprise?id=<?= e($entreprises['id']) ?>" class="btn btn-danger btn-sm">Supprimer</a>
          <?php if ($entreprises['confirme'] == 0){ ?>
              <a href="<?= URL ?>/users/list/entreprise/confirme?id=<?= e($entreprises['id']) ?>" class="btn btn-primary btn-sm">Confirmer</a>
          <?php } ?>
        </td>
      </tr>
    <?php } ?>
  </tbody>
</table>
</div>


