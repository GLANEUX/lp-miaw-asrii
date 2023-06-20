<h1>Modifer un enseignant</h1> 
  <div class="container">
    <div class="column">
<form method="POST" action="<?= URL ?>/users/edit/enseignant" >
<label for="name">Nom :</label>
  <input type="text" placeholder="Nom"  name="nom" id="nom" required value="<?= $data['etu']['nom']?>">
  <label for="name">Prénom :</label>
  <input type="text" placeholder="Prénom"  name="prenom" id="prenom" required value="<?= $data['etu']['prenom']?>">
  <label for="name">Adresse :</label>
  <input type="text" placeholder="Adresse"  name="adresse" id="adresse" required value="<?= $data['add']['adresse']?>">
  <label for="name">Complément d'adresse :</label>
  <input type="text" placeholder="Complément d'adresse (optionnel)"  name="complement" id="complement" value="<?= $data['add']['complement']?>">
  <label for="name">Code postal :</label>
  <input type="text" placeholder="Code postal"  name="code_postal" id="code_postal" value="<?= $data['add']['code_postal']?>">
  <label for="name">Ville :</label>
  <input type="text" placeholder="Ville"  name="ville" id="ville" value="<?= $data['add']['ville']?>">
  <label for="name">Nom d'utilisateur :</label>
  <input type="text" placeholder="Nom d'utilisateur"  name="username" id="username" required value="<?= $data['etu']['username']?>"> 
  <label for="name">Adresse mail :</label>
  <input type="email" placeholder="Adresse e-mail"  name="email" id="email" required value="<?= $data['etu']['email']?>">
  <input type="hidden" name="id" id="id" value="<?=$data['etu']['id']?>">
  <input type="hidden" name="add_id" id="add_id" value="<?=$data['add']['add_id']?>">

  <input type="submit" value="Envoyer" class="button"> <a href="<?= URL ?>/home" class="retour">Retour</a>
</form>

</div>
  </div>
