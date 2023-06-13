<!-- Affiche les supports de cours -->
<!-- Accessible uniquement pour les Etudiants, Enseignants ou les Admins -->
<!-- Accessible sur /supports -->

<?php foreach ($data['sup'] as $sup) { ?>
    <a href="<?= URL ?>/supports?id=<?= $sup['id'] ?>"> <?= $sup['matiere'] ?> - <?= $sup['titre'] ?> </a>
<?php } ?>
<iframe src="<?= URL . $data['url']; ?>" ></iframe>
<?php if ( ($_SESSION['level'] == 'enseignant') || ($_SESSION['level'] == 'administrateur')) { ?>
        <a href="<?= URL ?>/supports/add"> Ajouter </a>
        <?php if (isset($_GET['id'])) {?>
            <a href="<?= URL ?>/supports/delete?id=<?= $_GET['id'] ?>"> Supprimer </a>
        <?php } ?>
<?php }