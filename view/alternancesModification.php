<form method="post" action="<?= URL ?>/offres/edit">
    <label>Titre
        <input type="text" name="poste" value="<?=$data['alternances']['poste']?>">
    </label>
    <label>Description
        <input type="text" name="entreprise" value="<?=$data['alternances']['entreprise']?>">
    </label>
    <input type="hidden" name="id" value="<?=$data['alternances']['id']?>">
    <input type="submit">
</form>