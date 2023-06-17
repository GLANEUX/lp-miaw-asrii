<!-- Formulaire pour ajouter une offre d'alternance -->
<!-- Accessible uniquement pour les Entreprises ou les Admins -->
<!-- Accessible sur /offres/add -->
<!-- Ne pas modifier ou supprimer les names ou les id. -->
<h1>Proposer une offre d'alternance</h1> 
  <div class="container">
    <div class="column">
<form method="post" action="<?= URL ?>/offres/add">
    <label>Poste
        <input type="text" name="poste" id="poste" >
    </label>
    <label>Description
        <textarea name="description" id="description" ></textarea>
    </label>
    <?php if ($_SESSION['level'] == 'administrateur') {?>
        <label>Entreprise
            <select name="entreprise_id" id="entreprise_id">
                <?php foreach ($data['entreprises'] as $entreprises) { ?>
                    <option value="<?= $entreprises['id'] ?>"><?= $entreprises['name'] ?></option>
                <?php } ?>
            </select>
        </label>
    <?php } ?>
    <input type="submit" value="Envoyer" class="button"> <a href="<?= URL ?>/home" class="retour">Retour</a>
</form>
    </div></div>


