<?php
class HomeController {
    public function index() {
        // Charger les données nécessaires pour la vue
        $data = [
            'title' => 'Page d\'accueil'
        ];

        // Inclure le fichier d'en-tête
        require 'view/header.php';

        // Afficher la vue
        require 'view/home.php';

        // Inclure le fichier de pied de page
        require 'view/footer.php';
    }
}
