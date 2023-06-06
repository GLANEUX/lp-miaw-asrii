<?php

// Définir les routes de l'application
$routes = [
    URL . '/' => ['HomeController', 'index'],
    URL . '/connexion' => ['ConnexionController', 'index'],
    URL . '/home' => ['HomeConnectedController', 'index'],
    URL . '/deconnexion' => ['DeconnexionController', 'index'],
    URL . '/projets' => ['ProjetsController', 'index'],
    URL . '/projets/list' => ['ProjetsController', 'list'],
    URL . '/projets/add' => ['ProjetsController', 'ajouter'],
    URL . '/projets/edit' => ['ProjetsController', 'modifier'],
    URL . '/formations' => ['FormationsController', 'index'],
    URL . '/entreprises' => ['EntreprisesController', 'index'],
    URL . '/campus' => ['CampusController', 'index'],
    URL . '/alternances' => ['AlternancesController', 'index'],
    URL . '/offres' => ['AlternancesController', 'list'],
    URL . '/offres/add' => ['AlternancesController', 'ajouter'],
    URL . '/offres/edit' => ['AlternancesController', 'modifier'],
    // Ajoutez d'autres routes selon vos besoins
];
