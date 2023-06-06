<!DOCTYPE html>
<html>

<head>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="public/css/style.css" />

    <title>
        <?php echo $data['title']; ?>
    </title>

</head>

<body>

    <!-- Nav-bar -->
    <header class="sticky-top">
  <nav class="navbar navbar-expand-md navbar-dark bg-custom-black justify-content-between">
    <a class="navbar-brand w-25" href="<?= URL ?>"><img class="logo" src="public/img/ASRII_TXT-V.png" alt="Logo"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse w-50 justify-content-center" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item active">
          <a class="nav-link" href="<?= URL ?>">Accueil</a>
        </li>
        <li class="nav-item">
          <a class="nav-link mx-3"href="<?= URL ?>/formations">Formation</a>
        </li>
        <li class="nav-item">
          <a class="nav-link mx-3"href="<?= URL ?>/campus">Campus</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?= URL ?>/entreprises">Espace Entreprise</a>
        </li>
        
      </ul>
    </div>
    <div class="ml-auto w-25 mx-5">
    <ul class="navbar-nav justify-content-end">
        <li class="nav-item active ">
        <?php 
            if (isset($_SESSION['is_logged_in']) && isset($_SESSION['level']) && $_SESSION['is_logged_in'] == true && $_SESSION['level'] !== null) { ?>
                <a href="deconnexion" class="nav-link"> Déconnexion </a>
            <?php } else { ?>
                <a href="connexion" class="nav-link"> Connexion </a>
            <?php } 
        ?>
        </li>
    </ul>
      
    </div>
  </nav>
</header>

