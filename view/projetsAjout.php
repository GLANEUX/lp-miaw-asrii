<!DOCTYPE html>
<html>
<head>
  <title>Proposer un Projet Tuteuré</title>
</head>
<body>
<h1>Proposer un Projet Tuteuré</h1> 
  <div class="container">
    <div class="column">
      <form action="#" method="post">
        <label for="entreprise">Nom de l'entreprise :</label>
        <input type="text" id="entreprise" name="entreprise" value="" required>

        <label for="contact">Personne de contact :</label>
        <input type="text" id="contact" name="contact" value="" required>

        <label for="email">Adresse e-mail :</label>
        <input type="text" id="email" name="email" value="" required>
      </div>

      <div class="column">
        <label for="telephone">Numéro de téléphone :</label>
        <input type="text" id="telephone" name="telephone" value="" required>

        <label for="projet">Description du projet :</label>
        <textarea id="projet" name="projet" rows="5" required></textarea>

        <input type="submit" value="Envoyer">
      </form>
    </div>
  </div>
</body>
</html>
