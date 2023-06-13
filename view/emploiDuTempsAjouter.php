<!-- Accessible uniquement pour les Enseignants ou les Admins -->
<!-- Ne pas modifier ou supprimer les names ou les id. -->
<!-- Accessible sur /emplois-du-temps/add -->

<form method="post" enctype="multipart/form-data" action="<?= URL ?>/emplois-du-temps/add">
    <label>Date
        <input type="date" name="date" id="date" >
    </label>
    <label>Fichier
        <input type="file" name="edt" id="edt" >
    </label>
    <input type="submit">
</form>