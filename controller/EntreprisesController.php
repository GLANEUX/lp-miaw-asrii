<?php
class EntreprisesController {
    public function index() {
        session_start();
        // Charger les données nécessaires pour la vue
        $data = [
            'title' => 'Entreprises',
            'style' => [
                'header.css',
                'footer.css'
            ]
        ];

        // Inclure le fichier d'en-tête
        require 'view/header.php';

        // Afficher la vue
        require 'view/entreprises.php';

        // Inclure le fichier de pied de page
        require 'view/footer.php';
    }
}
