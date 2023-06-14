<!-- Affiche les emplois du temps -->
<!-- Accessible uniquement pour les Etudiants, Entreprises, Enseignants ou les Admins -->
<!-- Accessible sur /emplois-du-temps -->

<?php foreach ($data['edt'] as $edt) { ?>

    <a target="_blank" href="<?=  URL . $data['url'] ?>"> <?= $edt['date'] ?> </a>
    <?php } ?>
<iframe src="<?= URL . $data['url']; ?>" ></iframe>
<?php if ( ($_SESSION['level'] == 'enseignant') || ($_SESSION['level'] == 'administrateur')) { ?>
        <a href="<?= URL ?>/emplois-du-temps/add"> Ajouter </a>
        <?php if (isset($_GET['id'])) {?>
            <a href="<?= URL ?>/emplois-du-temps/delete?id=<?= $_GET['id'] ?>"> Supprimer </a>
        <?php } ?>
<?php }