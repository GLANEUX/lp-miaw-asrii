<?php foreach ($data['edt'] as $edt) {
    if (is_array($edt) && isset($edt['date'])) {
        ?>
        <a href="<?= URL ?>/emplois-du-temps?id=<?= $edt['id'] ?>"> <?= $edt['date'] ?> </a>
    <?php
    }
} ?>
<iframe src="<?= URL . $data['edt']['url']; ?>" ></iframe>