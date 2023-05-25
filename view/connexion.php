
<h1>Connexion</h1>
<form method="POST" action="">
    <?php if (isset($error)) { ?>
        <p><?= $error ?></p>
    <?php } ?>
    <label for="email_or_username">Email ou pseudo :</label>
    <input type="text" name="email_or_username" id="email_or_username" required><br>

    <label for="password">Mot de passe :</label>
    <input type="password" name="password" id="password" required><br>

    <input type="submit" value="Se connecter">
</form>
