<!-- Formulaire pour ajouter une note -->
<!-- Accessible uniquement pour les Enseignants ou les Admins -->
<!-- Accessible sur /notes/add?id=id_de_l_etudiant (Il est plus simple d'aller sur /notes puis "Ajouter une note") -->
<!-- Ne pas modifier ou supprimer les names ou les id. -->

<form method="post" action="<?= URL ?>/notes/add">
    <label>Matiere
        <input type="text" name="matiere" id="matiere" >
    </label>
    <label>Libelle
        <input type="text" name="libelle" id="libelle" >
    </label>
    <label>Note
        <input type="number" min="0" step="0.01" max="20" name="note" id="note" >
    </label>
    <label>Commentaire
        <textarea name="commentaire" id="commentaire" ></textarea>
    </label>
    <?php if ($_SESSION['level'] == 'administrateur') {?>
        <label>Enseignant
            <select name="enseignant_id" id="enseignant_id">
                <?php foreach ($data['enseignant'] as $enseignant) { ?>
                    <option value="<?= $enseignant['id'] ?>"><?= $enseignant['name'] ?></option>
                <?php } ?>
            </select>
        </label>
    <?php } ?>
    <input type="hidden" name="idetudiant" id="idetudiant" value="<?= $_GET['id'] ?>" />
    <input type="submit">
</form>