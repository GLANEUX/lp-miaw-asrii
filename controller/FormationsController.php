<?php
class FormationsController {
    public function index() {
        session_start();
        // Charger les données nécessaires pour la vue
        $data = [
            'title' => 'Formations',
            'style' => [
            'header.css',
            'footer.css',
            'banner.css',
            'formation.css'],
        ];

        // Inclure le fichier d'en-tête
        require 'view/header.php';

        // Afficher la vue
        require 'view/formations.php';

        // Inclure le fichier de pied de page
        require 'view/footer.php';
    }
}
