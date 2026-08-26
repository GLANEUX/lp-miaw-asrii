<?php
class HomeController {
    public function index() {
        if (session_status() === PHP_SESSION_NONE) session_start();
        // Charger les données nécessaires pour la vue
        $data = [
            'title' => 'Page d\'accueil',
            'style' => [
                'header.css',
                'footer.css',
                'banner.css',
                'home.css'
            ]
        ];

        // Inclure le fichier d'en-tête
        require 'view/header.php';

        // Afficher la vue
        require 'view/home.php';

        // Inclure le fichier de pied de page
        require 'view/footer.php';
    }
}
