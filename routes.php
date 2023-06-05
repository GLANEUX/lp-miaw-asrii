<?php

// Définir les routes de l'application
$routes = [
    URL . '/' => ['HomeController', 'index'],
    URL . '/connexion' => ['ConnexionController', 'index'],
    URL . '/home' => ['HomeConnectedController', 'index'],
    URL . '/deconnexion' => ['DeconnexionController', 'index'],
    // Ajoutez d'autres routes selon vos besoins
];
