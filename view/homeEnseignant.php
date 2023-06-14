<!-- Affiche l'espace enseignant -->
<!-- Accessible uniquement pour les Enseignants -->
<!-- Accessible sur /home (Connecté en enseignant) -->


<section class="bg-custom-grey p-4 pb-0">
  <div class=" py-2 px-3 rounded bg-white">
    <h2>Bienvenue - Enseignants</h2>
  </div>
</section>
<section class="bg-custom-grey px-5 py-3">
 

<div class="row g-5 py-3">
    <div class="col-6">
      <div class="bg-custom-black p-2 text-white">Projet tuteuré</div>
      <div class="bg-white p-3">
        <table class="table">
          <thead class="thead-dark">
            <tr>
              <th>Titre</th>
              <th>Description</th>
              <th>Voir plus</th>

            </tr>
          </thead>
          <tbody>
            <?php foreach ($data['projets'] as $projet) { ?>
              <tr>
                <td>
                  <?= $projet['titre'] ?>
                </td>
                <td>
                  <pre><?= $projet['description'] ?></pre>
                </td>
                <td>
                  <a href="<?= URL ?>/projets/list" class="btn btn-primary btn-sm">Voir plus</a>

                </td>


              </tr>
            <?php } ?>
          </tbody>
        </table>

      </div>
    </div>
    <div class="col-6">
      <div class="bg-custom-black p-2 text-white">Offres d'alternance</div>
      <div class="bg-white p-3">
        <table class="table">
          <thead class="thead-dark">
            <tr>
              <th>Titre</th>
              <th>Description</th>
              <th>Voir plus</th>

            </tr>
          </thead>
          <tbody>
            <?php foreach ($data['alternances'] as $alternances) { ?>
              <tr>
                <td>
                  <?= $alternances['poste'] ?>
                </td>
                <td>
                  <pre><?= $alternances['description'] ?></pre>
                </td>

                <td>
                  <a href="<?= URL ?>/offres" class="btn btn-primary btn-sm">Voir plus</a>
                </td>

              <?php } ?>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</section>
</section>




<a href="<?= URL ?>/emplois-du-temps"> Emplois du temps </a> <br />
<a href="<?= URL ?>/notes"> Notes </a> <br />
<a href="<?= URL ?>/supports"> Supports de cours </a> <br />
