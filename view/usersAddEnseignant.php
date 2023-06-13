<!-- Formulaire pour ajouter un enseignant -->
<!-- Accessible uniquement pour les Admins -->
<!-- Accessible sur /users/add/enseignant -->
<!-- Ne pas modifier ou supprimer les names ou les id. -->

<form method="POST" action="">
  <input type="text" placeholder="Nom"  name="nom" id="nom" required>
  <input type="text" placeholder="Prénom"  name="prenom" id="prenom" required>
  <input type="text" placeholder="Adresse"  name="adresse" id="adresse" required>
  <input type="text" placeholder="Complément d'adresse (optionnel)"  name="complement" id="complement">
  <input type="text" placeholder="Code postal"  name="code_postal" id="code_postal">
  <input type="text" placeholder="Ville"  name="ville" id="ville">
  <input type="text" placeholder="Nom d'utilisateur"  name="username" id="username" required>
  <input type="email" placeholder="Adresse e-mail"  name="email" id="email" required>
  <input type="password" placeholder="Mot de passe" name="password" id="password" required>
  <input type="submit" value="Inscrire" class="button">
</form>

