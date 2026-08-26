<!-- Formulaire pour ajouter un projet -->
<!-- Accessible uniquement pour les Entreprises ou les Admins -->
<!-- Accessible sur /projets/add -->
<!-- Ne pas modifier ou supprimer les names ou les id. -->

<h1>Proposer un Projet Tuteuré</h1> 
  <div class="container">
    <div class="column">
      <form action="<?= URL ?>/projets/add" method="post">
        <label for="text">Titre du projet :</label>
        <input type="text" id="titre" name="titre" value="" placeholder="Titre du projet" required>
        <?php if ($_SESSION['level'] == 'administrateur') {?>
            <label>Entreprise
                <select name="entreprise_id" id="entreprise_id">
                    <?php foreach ($data['entreprises'] as $entreprises) { ?>
                        <option value="<?= e($entreprises['id']) ?>"><?= e($entreprises['name']) ?></option>
                    <?php } ?>
                </select>
            </label>
        <?php } ?>
      </div>

      <div class="column">

        <label for="description">Description du projet :</label>
        <textarea id="description" name="description" rows="5" placeholder="Description du projet" required></textarea>

        <input type="submit" value="Envoyer" class="button"> <a href="<?= URL ?>/home" class="retour">Retour</a>
      </form>
    </div>
  </div>
