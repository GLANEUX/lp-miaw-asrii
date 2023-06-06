
<section class="co">
<form method="POST" action="" class="login">
    <?php if (isset($error)) { ?>
        <p><?= $error ?></p>
    <?php } ?>
  <input type="text" placeholder="Nom d'utilisateur"  name="email_or_username" id="email_or_username" required>
  <input type="password" placeholder="Mot de passe" name="password" id="password" required>
<input type="submit" value="Se connecter" class="button">
</form>
</section>

