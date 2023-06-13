<!-- Accessible uniquement pour les Enseignants ou les Admins -->
<!-- Accessible sur /supports/add -->
<!-- Ne pas modifier ou supprimer les names ou les id. -->

<form method="post" enctype="multipart/form-data" action="<?= URL ?>/supports/add">
    <label>Matière
        <input type="text" name="matiere" id="matiere" >
    </label>
    <label>Titre
        <input type="text" name="titre" id="titre" >
    </label>
    <?php if ($_SESSION['level'] == 'administrateur') {?>
        <label>Enseignant
            <select name="enseignant" id="enseignant">
                <?php foreach ($data['enseignant'] as $enseignant) { ?>
                    <option value="<?= $enseignant['id'] ?>"><?= $enseignant['name'] ?></option>
                <?php } ?>
            </select>
        </label>
    <?php } ?>
    <label>Fichier
        <input type="file" name="sup" id="sup" >
    </label>
    <input type="submit">
</form>