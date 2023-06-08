<form method="post" action="<?= URL ?>/notes/add">
    <label>Matiere
        <input type="text" name="matiere" >
    </label>
    <label>Libelle
        <input type="text" name="libelle" >
    </label>
    <label>Note
        <input type="number" min="0" step="0.01" max="20" name="note" >
    </label>
    <input type="hidden" name="idetudiant" value="<?= $_GET['id'] ?>" />
    <input type="submit">
</form>