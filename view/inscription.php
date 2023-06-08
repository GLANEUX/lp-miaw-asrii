
<section class="co">
<form method="POST" action="" class="login">
    <?php if (isset($error)) { ?>
        <p><?= $error ?></p>
    <?php } ?>
  <input type="text" placeholder="Nom"  name="nom" id="nom" required>
  <input type="text" placeholder="Prénom"  name="prenom" id="prenom" required>
  <input type="text" placeholder="Nom de l'entreprise"  name="entreprise" id="entreprise" required>
  <input type="email" placeholder="Adresse e-mail"  name="email" id="email" required>
  <input type="password" placeholder="Mot de passe" name="password" id="password" required>
<input type="submit" value="Se connecter" class="button">
</form>
</section>

