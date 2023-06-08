<?php foreach ($data['edt'] as $edt) {
    if (is_array($edt) && isset($edt['date'])) {
        ?>
        <a href="<?= URL ?>/emplois-du-temps?id=<?= $edt['id'] ?>"> <?= $edt['date'] ?> </a>
    <?php
    }
} ?>
<iframe src="<?= URL . $data['edt']['url']; ?>" ></iframe>
<?php if ( (isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true && isset($_SESSION['level']) && $_SESSION['level'] == 'enseignant') ||
    (isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true && isset($_SESSION['level']) && $_SESSION['level'] == 'admin')) { ?>
        <a href="<?= URL ?>/emplois-du-temps/add"> Ajouter </a>
<?php }