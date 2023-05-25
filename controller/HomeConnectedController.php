<?php

require_once 'model\SqlModel.php';

class HomeConnectedController {
    public function index() {
        session_start();

        // Entreprise
        if (
            isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true &&
            isset($_SESSION['level']) && $_SESSION['level'] == 'entreprise'
        ) {

            // Charger les données nécessaires pour la vue
            $data = [
                'title' => 'Espace Entreprise',
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
            require 'view/homeEntreprise.php';

            // Inclure le fichier de pied de page
            require 'view/footer.php';
        } 

        // Etudiant
        elseif (
            isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true &&
            isset($_SESSION['level']) && $_SESSION['level'] == 'etudiant'
        ) {

            // Charger les données nécessaires pour la vue
            $data = [
                'title' => 'Espace Etudiant',
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
            require 'view/homeEtudiant.php';

            // Inclure le fichier de pied de page
            require 'view/footer.php';
        } 

        // Enseignant
        elseif (
            isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true &&
            isset($_SESSION['level']) && $_SESSION['level'] == 'enseignant'
        ) {

            // Charger les données nécessaires pour la vue
            $data = [
                'title' => 'Espace Enseignant',
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
            require 'view/homeEnseignant.php';

            // Inclure le fichier de pied de page
            require 'view/footer.php';
        } 

        // Admin
        elseif (
            isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true &&
            isset($_SESSION['level']) && $_SESSION['level'] == 'admin'
        ) {

            // Charger les données nécessaires pour la vue
            $data = [
                'title' => 'Espace Administrateur',
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
            require 'view/homeAdmin.php';

            // Inclure le fichier de pied de page
            require 'view/footer.php';
        } 
        
        else {
            // L'utilisateur n'est pas connecté, redirigez-le vers la page de connexion
            header('Location: connexion');
            exit;
        }

        
    }
}
