<!-- Liste des offres d'alternance -->
<!-- Accessible uniquement pour les Etudiants, Entreprises, Enseignants ou les Admins -->
<!-- Accessible sur /offres -->

<?php foreach ($data['alternances'] as $alternances) { ?>
    <h2> <?= $alternances['poste'] ?> </h2>
    <p><pre><?= $alternances['description'] ?></pre></p>
    <?php if ($_SESSION['level'] != 'entreprise') {?>
        <p> <?= $alternances['societe'] ?> </p>
        <p> <?= $alternances['adresse'] . ', '. $alternances['code_postal'] . ' ' . $alternances['ville'] ?> </p>
        <p><?= $alternances['numero'] ?></p>
        <p><?= $alternances['email'] ?></p>
    <?php } if ( ($_SESSION['level'] == 'entreprise') || ($_SESSION['level'] == 'administrateur')) { ?>
        <a href="<?= URL ?>/offres/edit?id=<?=$alternances['id']?>"> Modifier </a>
        <a href="<?= URL ?>/offres/delete?id=<?=$alternances['id']?>"> Supprimer </a>
    <?php }

} ?>









<style>header{ display: none;} footer{display: none;}</style>