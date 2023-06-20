


  <h1>Modifer un Administrateur</h1> 
  <div class="container">
    <div class="column">
<form method="POST" action="<?= URL ?>/users/edit/administrateur" >
<label for="name">Nom :</label>
  <input type="text" placeholder="Nom"  name="nom" id="nom" required value="<?= $data['admin']['nom']?>">
  <label for="prenom">Prénom</label>
  <input type="text" placeholder="Prénom"  name="prenom" id="prenom" required value="<?= $data['admin']['prenom']?>">
  <label for="text">Nom d'utilisateur</label>
  <input type="text" placeholder="Nom d'utilisateur"  name="username" id="username" required value="<?= $data['admin']['username']?>">
  <label for="text">Adresse e-mail</label>
  <input type="email" placeholder="Adresse e-mail"  name="email" id="email" required value="<?= $data['admin']['email']?>">

  <input type="hidden" name="id" id="id" value="<?=$data['admin']['id']?>">

  <input type="submit"value="Envoyer" class="button"> <a href="<?= URL ?>/home" class="retour">Retour</a>
</form>

</div>
  </div>
