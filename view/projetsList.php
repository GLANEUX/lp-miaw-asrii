
<?php foreach ($data['projets'] as $projets) { ?>
    <h2> <?= $projets['titre'] ?> </h2>
    <p> <?= $projets['description'] ?> </p>
    <?php if ( (isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true && isset($_SESSION['level']) && $_SESSION['level'] == 'entreprise') ||
    (isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true && isset($_SESSION['level']) && $_SESSION['level'] == 'admin')) { ?>
        <a href="<?= URL ?>/projets/edit?id=<?=$projets['id']?>"> Modifier </a>
    <?php }

} ?>