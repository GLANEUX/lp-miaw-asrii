<!DOCTYPE html>
<html>
    <head>

        <!-- Bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
        
        <!-- Font Awesome -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
        
        <!-- Custom -->
        <?php if (isset($data['style'])) {
            foreach ($data['style'] as $style) { ?>
                <link rel="stylesheet" type="text/css" href="<?=URL?>/public/css/<?= $style ?>" />
            <?php } 
        } ?>

        <title><?php echo $data['title']; ?></title>
        
    </head>
    <body>
        <?php 
            if (isset($_SESSION['is_logged_in']) && isset($_SESSION['level']) && $_SESSION['is_logged_in'] == true && $_SESSION['level'] !== null) { ?>
                <a href="deconnexion"> Déconnexion </a>
            <?php } else { ?>
                <a href="connexion"> Connexion </a>
            <?php } 
        ?>
