<form method="post" action="<?= URL ?>/notes/edit">
    <label>Matiere
        <input type="text" name="matiere" value="<?= $data['notes']['matiere']?>">
    </label>
    <label>Libelle
        <input type="text" name="libelle" value="<?= $data['notes']['libelle']?>">
    </label>
    <label>Note
        <input type="number" min="0" step="0.01" max="20" name="note" value="<?= $data['notes']['note']?>">
    </label>
    <input type="hidden" name="idnote" value="<?= $data['notes']['id']?>" />
    <input type="submit">
</form>