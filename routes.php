<?php

// Définir les routes de l'application
$routes = [
    URL . '/' => ['HomeController', 'index'],
    URL . '/connexion' => ['ConnexionController', 'index'],
    URL . '/home' => ['HomeConnectedController', 'index'],
    URL . '/deconnexion' => ['DeconnexionController', 'index'],
    URL . '/projet' => ['ProjetController', 'index'],
    URL . '/projet/list' => ['ProjetController', 'consulter'],
    URL . '/projet/add' => ['ProjetController', 'ajouter'],
    URL . '/projet/edit' => ['ProjetController', 'modifier'],
    URL . '/formations' => ['FormationsController', 'index'],
    URL . '/entreprises' => ['EntreprisesController', 'index'],
    // Ajoutez d'autres routes selon vos besoins
];
