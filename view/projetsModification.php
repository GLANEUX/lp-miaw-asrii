<form method="post" action="<?= URL ?>/projets/edit">
    <label>Titre
        <input type="text" name="titre" value="<?=$data['projets']['titre']?>">
    </label>
    <label>Description
        <input type="text" name="description" value="<?=$data['projets']['description']?>">
    </label>
    <input type="hidden" name="id" value="<?=$data['projets']['id']?>">
    <input type="submit">
</form>