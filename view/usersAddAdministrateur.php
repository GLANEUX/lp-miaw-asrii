<!-- Formulaire pour ajouter un administrateur -->
<!-- Accessible uniquement pour les Admins -->
<!-- Accessible sur /users/add/administrateur -->
<!-- Ne pas modifier ou supprimer les names ou les id. -->

<h1>Ajouter un administrateur</h1> 
  <div class="container">
    <div class="column">
<form method="POST" action="<?= URL ?>/users/add/administrateur" >
<label for="name">Nom :</label>
  <input type="text" placeholder="Nom"  name="nom" id="nom" required>
  <label for="prenom">Prénom</label>
  <input type="text" placeholder="Prénom"  name="prenom" id="prenom" required>
  <label for="text">Nom d'utilisateur</label>
  <input type="text" placeholder="Nom d'utilisateur"  name="username" id="username" required>
  <label for="text">Adresse e-mail</label>
  <input type="email" placeholder="Adresse e-mail"  name="email" id="email" required>
  <label for="text">Mot de passe</label>
  <input type="password" placeholder="Mot de passe" name="password" id="password" required>
  <input type="submit"value="Envoyer" class="button"> <a href="<?= URL ?>/home" class="retour">Retour</a>
</form>

</div>
  </div>
