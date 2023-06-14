<!-- Formulaire pour modifier une offre d'alternance -->
<!-- Accessible uniquement pour les Entreprises ou les Admins -->
<!-- Ne pas modifier ou supprimer les names ou les id. -->
<!-- Accessible sur /offres/edit?id=id_de_l_offre (Il est plus simple d'aller sur /offres puis "Modifier") -->
<h1>Modifier une offre d'alternance</h1> 
<div class="container">
    <div class="column">
<form method="post" action="<?= URL ?>/offres/edit">
    <label>Poste
        <input type="text" name="poste" id="poste" value="<?=$data['alternances']['poste']?>">
    </label>
    <label>Description
        <textarea name="description" id="description"><?=$data['alternances']['description']?></textarea>
    </label>
    <input type="hidden" name="id" id="id" value="<?=$data['alternances']['id']?>">
    <input type="submit" value="Envoyer" class="button"> <a href="<?= URL ?>/home" class="retour">Retour</a>
</form>
</div></div>


