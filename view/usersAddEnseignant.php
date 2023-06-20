<!-- Formulaire pour ajouter un enseignant -->
<!-- Accessible uniquement pour les Admins -->
<!-- Accessible sur /users/add/enseignant -->
<!-- Ne pas modifier ou supprimer les names ou les id. -->

<h1>Ajouter un enseignant</h1> 
  <div class="container">
    <div class="column">
<form method="POST" action="<?= URL ?>/users/add/enseignant" >
<label for="name">Nom :</label>
  <input type="text" placeholder="Nom"  name="nom" id="nom" required>
  <label for="name">Prénom :</label>
  <input type="text" placeholder="Prénom"  name="prenom" id="prenom" required>
  <label for="name">Adresse :</label>
  <input type="text" placeholder="Adresse"  name="adresse" id="adresse" required>
  <label for="name">Complément d'adresse :</label>
  <input type="text" placeholder="Complément d'adresse (optionnel)"  name="complement" id="complement">
  <label for="name">Code postal :</label>
  <input type="text" placeholder="Code postal"  name="code_postal" id="code_postal">
  <label for="name">Ville :</label>
  <input type="text" placeholder="Ville"  name="ville" id="ville">
  <label for="name">Nom d'utilisateur :</label>
  <input type="text" placeholder="Nom d'utilisateur"  name="username" id="username" required>
  <label for="name">Adresse mail :</label>
  <input type="email" placeholder="Adresse e-mail"  name="email" id="email" required>
  <label for="name">Mot de passe :</label>
  <input type="password" placeholder="Mot de passe" name="password" id="password" required>
  <input type="submit" value="Envoyer" class="button"> <a href="<?= URL ?>/home" class="retour">Retour</a>
</form>

</div>
  </div>
