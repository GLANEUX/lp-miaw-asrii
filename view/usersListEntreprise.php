<!-- Liste et gestion des entreprises -->
<!-- Accessible uniquement pour les Admins -->
<!-- Accessible sur /users/list/entreprise -->

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
          <a href="<?= URL ?>/users/list/entreprise?id=<?= $entreprises['id'] ?>" class="btn btn-danger btn-sm">Supprimer</a>
          <?php if ($entreprises['confirme'] == 0){ ?>
              <a href="<?= URL ?>/users/list/entreprise/confirme?id=<?= $entreprises['id'] ?>" class="btn btn-primary btn-sm">Confirmer</a>
          <?php } ?>
        </td>
      </tr>
    <?php } ?>
  </tbody>
</table>



<style>header{ display: none;} footer{display: none;}</style>