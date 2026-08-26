<!DOCTYPE html>
<html lang="fr">

<head>

  <meta charset="UTF-8">

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">


  <!-- CSS -->
  <?php if (isset($data['style'])) {
    foreach ($data['style'] as $style) { ?>
      <link rel="stylesheet" type="text/css" href="<?= URL ?>/public/css/<?= e($style) ?>" />
    <?php }
  } ?>
  <title>
    <?php echo e($data['title']); ?>
  </title>

</head>

<body>

  <!-- Nav-bar -->
  <header class="sticky-top">
    <nav class="navbar navbar-expand-md navbar-dark bg-custom-black justify-content-between">


      <div class="ml-auto with mx-5">
      <a class="" href="<?= URL ?>"><img class="w-50" src="<?= URL ?>/public/img/ASRII_LOGO-TXT-V.png"
          alt="Logo"></a>
      </div>

      <div class="collapse navbar-collapse w-60 justify-content-center" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item active">
            <a class="nav-link" href="<?= URL ?>">ACCUEIL</a>
          </li>
          <li class="nav-item">
            <a class="nav-link mx-3" href="<?= URL ?>/formations">FORMATION</a>
          </li>
          <li class="nav-item">
            <a class="nav-link mx-3" href="<?= URL ?>/campus">CAMPUS</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= URL ?>/entreprises">ESPACE ENTREPRISE</a>
          </li>
         


        </ul>
      </div>
      <div class="ml-auto with mx-5">
        <ul class="navbar-nav justify-content-end">
        <?php
          if (isset($_SESSION['is_logged_in']) && isset($_SESSION['level']) && $_SESSION['is_logged_in'] == true && $_SESSION['level'] !== null) { ?>
            <li class="nav-item">
              <a class="nav-link txt-color-purple" href="<?= URL ?>/home">MON
                ESPACE</a>
            </li>
            <li class="nav-item">
              <a class="nav-link">-</a>
            </li>
            
          <?php } ?>
          <li class="nav-item active ">
            <?php
            if (isset($_SESSION['is_logged_in']) && isset($_SESSION['level']) && $_SESSION['is_logged_in'] == true && $_SESSION['level'] !== null) { ?>
              <a href="<?= URL ?>/deconnexion" class="nav-link"> Déconnexion </a>
            <?php } else { ?>
              <a href="<?= URL ?>/connexion" class="nav-link"> Connexion </a>
            <?php }
            ?>
          </li>
        </ul>

      </div>
    </nav>
  </header>