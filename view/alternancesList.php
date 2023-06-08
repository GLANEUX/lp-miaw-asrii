
<?php foreach ($data['alternances'] as $alternances) { ?>
    <h2> <?= $alternances['poste'] ?> </h2>
    <p> <?= $alternances['entreprise'] ?> </p>
    <?php if ( (isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true && isset($_SESSION['level']) && $_SESSION['level'] == 'entreprise') ||
    (isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true && isset($_SESSION['level']) && $_SESSION['level'] == 'admin')) { ?>
        <a href="<?= URL ?>/offres/edit?id=<?=$alternances['id']?>"> Modifier </a>
    <?php }

} ?>









<style>header{ display: none;} footer{display: none;}</style>