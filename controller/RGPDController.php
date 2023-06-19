<?php
class RGPDController {
    public function index() {
        session_start();
        // Charger les données nécessaires pour la vue
        $data = [
            'title' => 'Politique de confidentialité',
            'style' => [
                'header.css',
                'footer.css',
                'banner.css',
                'rgpd.css'
            ]
        ];

        // Inclure le fichier d'en-tête
        require 'view/header.php';

        // Afficher la vue
        require 'view/rgpd.php';

        // Inclure le fichier de pied de page
        require 'view/footer.php';
    }
}
