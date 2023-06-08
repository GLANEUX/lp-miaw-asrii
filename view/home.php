<!-- Contenu de la page d'accueil -->
<section id="Banner" class="banner background-image"
  style="background-image: url('<?= URL ?>/public/img/Banner-HOME.jpg')">

  <div class="banner-overlay "></div>
  <div class="banner-content">
    <h1 class="">ASRII</h1>
    <h2 class="txt-font">PRÉSENTATION</h2>
  </div>
  <div class="logo-banner">
  <img src="<?= URL ?>/public/img/logo_evry.png" class="card-img-top" alt="Image 1">
  </div>
</section>

<section id="Card">
  <div class="container py-5">
    <h2 class="txt-font text-center py-3 ">LA FORMATION ASRII</h2>

    <div class="row py-3">


      <div class="col-md-4">
        <a href="<?= URL ?>/formations" class="none">
          <div class="card">
            <img src="<?= URL ?>/public/img/Formation-card-HOME.png" class="card-img-top" alt="Image 1">
            <div class="card-body">
              <h5 class="card-title text-center">Formation</h5>
            </div>
          </div>
        </a>
      </div>


      <div class="col-md-4">
        <a href="<?= URL ?>/campus" class="none">
          <div class="card">
            <img src="<?= URL ?>/public/img/Campus-card-HOME.jpg" class="card-img-top" alt="Image 1">
            <div class="card-body">
              <h5 class="card-title text-center">Campus</h5>
            </div>
          </div>
        </a>
      </div>

      <div class="col-md-4">
        <a target="_blank"
          href="<?= URL ?>/public/img/program-licence-professionnelle-metiers-de-l-informatique-application-web.PDF"
          class="none">
          <div class="card">
            <img src="<?= URL ?>/public/img/PDF-Card-HOME.png" class="card-img-top" alt="Image 1">
            <div class="card-body">
              <h5 class="card-title text-center">Brochure</h5>
            </div>
          </div>
        </a>
      </div>

    </div>


  </div>
</section>

<section id="Entreprise" class="bg-custom-black py-5">
  <div class="container py-3">
    <div class="row">

      <div class="col-lg-7">
        <h2 class="text-white txt-font">ENTREPRISES</h2>
        <p class="text-white">Nous sommes fiers de collaborer avec de nombreuses entreprises renommées dans divers secteurs d'activité. Leurs contributions et leur soutien sont essentiels pour offrir à nos étudiants une expérience d'apprentissage enrichissante et une mise en pratique concrète de leurs connaissances.</p>
        <div class=" py-3">
          <a href="<?= URL ?>/entreprises" class="bg-custom-purple txt-color-black button-font py-2 px-3 rounded">Entreprises partenaire</a>
        </div>
      </div>
  
      <div class="col-lg-5 align-items-center justify-content-end">
        <h2 class="text-white txt-font-h2 text-center">Vous êtes une entreprise ?</h2>
        <p class="text-white  text-center">Inscrivez-vous et déposez une offre d'alternance ou de projet tuteuré</p>

        <div class="text-center py-3 ">
          <a href="<?= URL ?>/inscription" class="bg-custom-purple txt-color-black button-font py-2 px-3 rounded">Inscription</a>
        </div>
       
      </div>

    </div>
  </div>
</section>

<section class="bg-fixed" style="background-image: url(<?= URL ?>/public/img/Campus-card-HOME.jpg);">

</section>


<section id="Etudiant">
  <div class="container py-5">
    <h2 class="txt-font text-center py-1">ETUDIANT - ENSEIGNANT - ENTREPRISE</h2>
    <h3 class="text-center">Connectez-vous à votre espace dédié</h3>
    <div class="text-center py-5">
      <?php
      if (isset($_SESSION['is_logged_in']) && isset($_SESSION['level']) && $_SESSION['is_logged_in'] == true && $_SESSION['level'] !== null) { ?>
        <a href="<?= URL ?>/deconnexion" class="bg-custom-purple txt-color-black button-font py-3 px-4 rounded">
          Déconnexion </a>
      <?php } else { ?>
        <a href="<?= URL ?>/connexion" class="bg-custom-purple txt-color-black button-font py-3 px-4 rounded"> Connexion
        </a>
      <?php }
      ?>
    </div>
  </div>
</section>