<!-- Formulaire d'inscription d'une entreprise -->
<!-- Accessible pour tous le monde -->
<!-- Accessible sur /inscription -->
<!-- Ne pas modifier ou supprimer les names ou les id. -->

<section class="co">
<form method="POST" action="" class="login">
    <?php if (isset($error)) { ?>
        <p><?= $error ?></p>
    <?php } ?>
  <input type="text" placeholder="Dénomination sociale"  name="societe" id="societe" required>
  <input type="number" placeholder="SIRET"  name="siret" id="siret" required>
  <input type="text" placeholder="Adresse"  name="adresse" id="adresse" required>
  <input type="text" placeholder="Complément d'adresse (optionnel)"  name="complement" id="complement">
  <input type="text" placeholder="Code postal"  name="code_postal" id="code_postal">
  <input type="text" placeholder="Ville"  name="ville" id="ville">
  <input type="tel" placeholder="Numéro de tel"  name="numero" id="numero" required>
  <input type="text" placeholder="Nom d'utilisateur"  name="username" id="username" required>
  <input type="email" placeholder="Adresse e-mail"  name="email" id="email" required>
  <input type="password" placeholder="Mot de passe" name="password" id="password" required>
  <input type="submit" value="Se connecter" class="button">
</form>
</section>

