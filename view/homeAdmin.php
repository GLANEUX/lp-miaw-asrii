<!-- Affiche l'espace administrateur -->
<!-- Accessible uniquement pour les Admins -->
<!-- Accessible sur /home (Connecté en admin) -->

<section class="bg-custom-grey p-4 pb-0">
  <div class=" py-2 px-3 rounded bg-white">
    <h2>Bienvenue - <?= $data['nom'] ?></h2>
  </div>
</section>

<section class="bg-custom-grey px-5 py-3">
<div class="row g-5 py-3">
<div class="col-12">
<div class="bg-custom-black p-2 text-white">utilisateurs   </div>
<div class="bg-white p-3">
<a href="<?= URL ?>/users/list/entreprise"  class="btn btn-primary btn-sm"> Lister les entreprises </a>
<a href="<?= URL ?>/users/list/enseignant" class="btn btn-primary btn-sm"> Lister les enseignants </a>
<a href="<?= URL ?>/users/list/administrateur" class="btn btn-primary btn-sm"> Lister les administrateurs </a>
<a href="<?= URL ?>/users/list/etudiant" class="btn btn-primary btn-sm"> Lister les etudiant </a>

</div>
</div>
</div>

  <div class="row g-5 py-3">
    <div class="col-5">
      <div class="bg-custom-black p-2 text-white">Mes notes <a href="<?= URL ?>/notes" class="see-more"> - voir plus</a>
      </div>
      <div class="bg-white p-3">


        <table class="table">
          <thead class="thead-dark">
            <tr>
              <th>Nom</th>
              <th>Prénom</th>
              <th>Consulter</th>
              <th>Ajouter</th>

            </tr>
          </thead>
          <tbody>
            <?php foreach ($data['etudiants'] as $etudiant) { ?>
              <tr>
                <td>
                  <?= $etudiant['nom'] ?>
                </td>

                <td>
                  <?= $etudiant['prenom'] ?>
                </td>
                <td><a href="<?= URL ?>/notes?id=<?= $etudiant['id'] ?>" class="btn btn-primary btn-sm">Consulter les
                    notes</a></td>
                <td><a href="<?= URL ?>/notes/add?id=<?= $etudiant['id'] ?>" class="btn btn-success btn-sm">Ajouter une
                    note</a></td>
              </tr>
            <?php } ?>
          </tbody>
        </table>



      </div>

    </div>


    <div class="col-4">
      <div class="bg-custom-black p-2 text-white">Supports de cours <a href="<?= URL ?>/supports" class="see-more"> -
          voir plus</a></div>
      <div class="bg-white p-3">


      
<table class="table">
          <thead class="thead-dark">
            <tr>
              <th>Matière</th>
             
              <th>titre</th>
               <th>Actions</th>
            </tr>
          </thead>
          <tbody>
          <?php foreach ($data['sup'] as $sup) { ?>
              <tr>
                <td>
                <?= $sup['matiere'] ?>
                </td>
           
                <td>
                <a target="_blank" href="<?= URL . $data['url_s'] ?>"> <?= $sup['titre'] ?> </a>
                </td>
           
                 <td>  
            <a href="<?= URL ?>/supports/delete?id=<?= $sup['id'] ?>" class="btn btn-danger btn-sm"> Supprimer </a>
            
                 </td>
                <?php } ?>
              </tr>
          </tbody>
        </table>
      </div>
    </div>




    <div class="col-3">


      <div class="bg-custom-black p-2 text-white">Emplois du temps <a href="<?= URL ?>/emplois-du-temps"
          class="see-more"> - voir plus</a></div>
      <div class="bg-white p-3">

        <table class="table">
          <thead class="thead-dark">
            <tr>

              <th>Date</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($data['edt'] as $edt) { ?>
              <tr>
                <td>
                  <a target="_blank" href="<?= URL . $data['url'] ?>"> <?= $edt['date'] ?> </a>
                </td>

                <td>
                  <a href="<?= URL ?>/emplois-du-temps/delete?id=<?= $edt['id'] ?>" class="btn btn-danger btn-sm">
                    Supprimer </a>
                </td>
              </tr>
            <?php } ?>
          </tbody>
        </table>

      </div>

    </div>

  </div>


  <div class="row g-5 py-3">
    <div class="col-6">
      <div class="bg-custom-black p-2 text-white">Projet tuteuré <a href="<?= URL ?>/projets/list" class="see-more"> -
          voir plus</a></div>
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
      <div class="bg-custom-black p-2 text-white">Offres d'alternance <a href="<?= URL ?>/offres" class="see-more"> -
          voir plus</a></div>
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

