<!-- Formulaire pour modifier une note -->
<!-- Accessible uniquement pour les Enseignants ou les Admins -->
<!-- Accessible sur /notes/edit?id=id_de_la_note (Il est plus simple d'aller sur /notes puis "Consulter les notes" puis "Modifier") -->
<!-- Ne pas modifier ou supprimer les names ou les id. -->

<h1>modif une note</h1> 
  <div class="container">
    <div class="column">
<form method="post" action="<?= URL ?>/notes/edit">
    <label>Matiere
        <input type="text" name="matiere" id="matiere" value="<?= $data['note']['matiere']?>">
    </label>
    <label>Libelle
        <input type="text" name="libelle" id="libelle" value="<?= $data['note']['libelle']?>">
    </label>
    <label>Commentaire
        <textarea name="commentaire" id="commentaire"><?= $data['note']['commentaire']?></textarea>
    </label>
    <label>Note
        <input type="number" min="0" step="0.01" max="20" name="note" id="note" value="<?= $data['note']['note']?>">
    </label>
    <input type="hidden" name="idnote" id="idnote" value="<?= $data['note']['id']?>" />
    <input type="submit" value="Envoyer" class="button"> <a href="<?= URL ?>/home" class="retour">Retour</a>
</form>

</div>
  </div>

