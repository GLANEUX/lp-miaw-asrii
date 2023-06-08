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
    URL . '/notes' => ['NotesController', 'index'],
    URL . '/notes/edit' => ['NotesController', 'modifier'],
    URL . '/notes/add' => ['NotesController', 'ajouter'],
    URL . '/inscription' => ['InscriptionController', 'index'],
    URL . '/emplois-du-temps' => ['EDTController', 'index'],
    // Ajoutez d'autres routes selon vos besoins
];
