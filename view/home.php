
<!-- Contenu de la page d'accueil -->
<section id="Banner" class="banner background-image" style="background-image: url('public/img/Banner-HOME.jpg')">
  
  <div class="banner-overlay " ></div>
  <div class="banner-content" >
    <h1 class="">ASRII</h1>
    <h2 class="txt-font">PRÉSENTATION</h2>
  </div>
</section>

<section id="Card">
  <div class="container py-5">
    <h2 class="txt-font text-center py-3 ">LA FORMATION ASRII</h2>

    <div class="row py-3">

      <div class="col-md-4">
        <div class="card">
          <img src="public/img/Formation-card-HOME.png" class="card-img-top" alt="Image 1">
          <div class="card-body">
            <h5 class="card-title text-center">Formation</h5>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card">
          <img src="public/img/Campus-card-HOME.jpg" class="card-img-top" alt="Image 2">
          <div class="card-body">
            <h5 class="card-title text-center">Campus</h5>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card">
          <img src="public/img/PDF-Card-HOME.png" class="card-img-top" alt="Image 3">
          <div class="card-body">
            <h5 class="card-title text-center">Brochure</h5>
          </div>
        </div>
      </div>

    </div>


  </div>
</section>

<section id="Entreprise" class="bg-custom-black py-5">
  <div class="container py-3">
    <div class="row">

      <div class="col-lg-8">
        <h2 class="text-white txt-font">ENTREPRISE</h2>
        <p class="text-white">Texte de description de l'entreprise.</p>
      </div>

      <div class="col-lg-4 align-items-center justify-content-end">
      <h2 class="text-white text-center txt-font">ENTREPRISE</h2>
        <p class="text-white text-center">Texte de description de l'entreprise.</p>
        <div class="text-center py-5">
      <a href="#" class="bg-custom-purple txt-color-black button-font py-3 px-4 rounded">Connexion</a>
    </div>      </div>

    </div>
  </div>
</section>

<section class="bg-fixed" style="background-image: url(public/img/Campus-card-HOME.jpg);">

</section>


<section id="Etudiant">
  <div class="container py-5">
    <h2 class="txt-font text-center py-1">ETUDIANT - ENSEIGNANT - ENTREPRISE</h2>
    <h3 class="text-center">Connectez-vous à votre espace dédié</h3>
    <div class="text-center py-5">
    <?php 
            if (isset($_SESSION['is_logged_in']) && isset($_SESSION['level']) && $_SESSION['is_logged_in'] == true && $_SESSION['level'] !== null) { ?>
                <a href="deconnexion" class="bg-custom-purple txt-color-black button-font py-3 px-4 rounded"> Déconnexion </a>
            <?php } else { ?>
                <a href="connexion" class="bg-custom-purple txt-color-black button-font py-3 px-4 rounded"> Connexion </a>
            <?php } 
        ?>    </div>
  </div>
</section>
