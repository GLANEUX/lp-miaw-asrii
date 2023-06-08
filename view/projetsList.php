<table class="table">
  <thead class="thead-dark">
    <tr>
      <th>Titre</th>
      <th>Description</th>
      <?php if ((isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true && isset($_SESSION['level']) && $_SESSION['level'] == 'entreprise') ||
        (isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true && isset($_SESSION['level']) && $_SESSION['level'] == 'admin')) { ?>
        <th>Actions</th>
      <?php } ?>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($data['projets'] as $projets) { ?>
      <tr>
        <td><?= $projets['titre'] ?></td>
        <td><?= $projets['description'] ?></td>
        <?php if ((isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true && isset($_SESSION['level']) && $_SESSION['level'] == 'entreprise') ||
          (isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true && isset($_SESSION['level']) && $_SESSION['level'] == 'admin')) { ?>
          <td>
            <a href="<?= URL ?>/projets/edit?id=<?= $projets['id'] ?>" class="btn btn-primary btn-sm">Modifier</a>
          </td>
        <?php } ?>
      </tr>
    <?php } ?>
  </tbody>
</table>



<style>header{ display: none;} footer{display: none;}</style>