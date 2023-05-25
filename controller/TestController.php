<?php

require_once 'model\SqlModel.php';

class TestController {
    public function test() {
        // Instancier le modèle d'utilisateur
        $userModel = new SqlModel();
        
        // Appeler la méthode pour récupérer les utilisateurs
        $users = $userModel->getTableData($tableName = 'test');

        // Charger les données nécessaires pour la vue
        $data = [
            'title' => 'test',
            'style' => [
                'style.css'
            ],
            'script' => [
                'script.js'
            ]
        ];

        // Inclure le fichier d'en-tête
        require 'view/header.php';

        // Afficher la vue avec les données
        require 'view/test.php';

        // Inclure le fichier de pied de page
        require 'view/footer.php';
    }
}
