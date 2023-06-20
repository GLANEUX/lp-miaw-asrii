<!-- Accessible uniquement pour les Enseignants ou les Admins -->
<!-- Ne pas modifier ou supprimer les names ou les id. -->
<!-- Accessible sur /emplois-du-temps/add -->


<h1>Déposer un EDT</h1> 
  <div class="container">
    <div class="column">
      <form method="post" enctype="multipart/form-data" action="<?= URL ?>/emplois-du-temps/add">
    <label>Date
        <input type="date" name="date" id="date" >
    </label>
    <label>Fichier
        <input type="file" name="edt" id="edt" >
    </label>
    <input type="submit" value="Envoyer" class="button"> <a href="<?= URL ?>/home" class="retour">Retour</a>
</form>
     
    </div>
  </div>
