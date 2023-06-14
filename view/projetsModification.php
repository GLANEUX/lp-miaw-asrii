<!-- Formulaire pour modifier un projet -->
<!-- Accessible uniquement pour les Entreprises ou les Admins -->
<!-- Accessible sur /projets/edit?id=id_du_projet (Il est plus simple d'aller sur /projets/list puis "Modifier") -->
<!-- Ne pas modifier ou supprimer les names ou les id. -->
<h1>Modification Projet Tuteuré</h1> 
<div class="container">
    <div class="column">
<form method="post" action="<?= URL ?>/projets/edit">
    <label>Titre
        <input type="text" name="titre" id="titre" value="<?=$data['projets']['titre']?>">
    </label>
    <label>Description
        <textarea name="description" id="description"><?=$data['projets']['description']?></textarea>
    </label>
    <input type="hidden" name="id" id="id" value="<?=$data['projets']['id']?>">
    <input type="submit" class="button"> <a href="<?= URL ?>/home" class="retour">Retour</a>
</form>
    </div></div>