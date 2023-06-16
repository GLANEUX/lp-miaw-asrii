<!-- Formulaire pour ajouter un administrateur -->
<!-- Accessible uniquement pour les Admins -->
<!-- Accessible sur /users/add/administrateur -->
<!-- Ne pas modifier ou supprimer les names ou les id. -->

<h1>Proposer un Projet Tuteuré</h1> 
  <div class="container">
    <div class="column">
<form method="POST" action="" >
  <input type="text" placeholder="Nom"  name="nom" id="nom" required>
  <input type="text" placeholder="Prénom"  name="prenom" id="prenom" required>
  <input type="text" placeholder="Nom d'utilisateur"  name="username" id="username" required>
  <input type="email" placeholder="Adresse e-mail"  name="email" id="email" required>
  <input type="password" placeholder="Mot de passe" name="password" id="password" required>
  <input type="submit"value="Envoyer" class="button"> <a href="<?= URL ?>/home" class="retour">Retour</a>
</form>

</div>
  </div>
