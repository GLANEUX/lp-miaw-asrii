<h1>Modifer une entrerpise</h1> 
  <div class="container">
    <div class="column">
<form method="POST" action="<?= URL ?>/users/edit/entreprise" >
  <input type="text" placeholder="Dénomination sociale"  name="societe" id="societe" required value="<?=$data['etu']['societe']?>">
  <input type="number" placeholder="SIRET"  name="siret" id="siret" required value="<?=$data['etu']['siret']?>">
  <input type="text" placeholder="Adresse"  name="adresse" id="adresse" required value="<?=$data['add']['adresse']?>">
  <input type="text" placeholder="Complément d'adresse (optionnel)"  name="complement" id="complement" value="<?=$data['add']['complement']?>">
  <input type="text" placeholder="Code postal"  name="code_postal" id="code_postal" value="<?=$data['add']['code_postal']?>">
  <input type="text" placeholder="Ville"  name="ville" id="ville" value="<?=$data['add']['ville']?>">
  <input type="tel" placeholder="Numéro de tel"  name="numero" id="numero" required value="<?=$data['etu']['numero']?>">
  <input type="text" placeholder="Nom d'utilisateur"  name="username" id="username" required value="<?=$data['etu']['username']?>">
  <input type="email" placeholder="Adresse e-mail"  name="email" id="email" required value="<?=$data['etu']['email']?>">
  <input type="hidden" name="id" id="id" value="<?=$data['etu']['id']?>">
  <input type="hidden" name="add_id" id="add_id" value="<?=$data['add']['add_id']?>">
  <input type="submit" value="Envoyer" class="button"> <a href="<?= URL ?>/home" class="retour">Retour</a>
</form>
</div>
  </div>

