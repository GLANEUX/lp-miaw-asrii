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
             // Récupérer les données des projets depuis la base de données
             $sqlModel = new SqlModel();
             $query = $sqlModel->SqlRequest("SELECT id, titre, description FROM projets WHERE entreprise_id = $_SESSION[userid]");
 
             $projets = [];
             foreach ($query as $row) {
                 $projets[] = [
                     'id' => $row['id'],
                     'titre' => $row['titre'],
                     'description' => $row['description']
                 ];
             }


             
            // Récupérer la liste des offres d'alternance de l'entreprise de la base de données
            $sqlModel = new SqlModel();
            $query = $sqlModel->SqlRequest("SELECT id, poste, description FROM alternances WHERE entreprise_id = $_SESSION[userid]");

            // Stocker les offres d'alternance dans une variable
            $alternances = [];
            foreach ($query as $row) {
                $alternances[] = [
                    'id' => $row['id'],
                    'poste' => $row['poste'],
                    'description' => $row['description']
                ];
            }

 
            // Charger les données nécessaires pour la vue
            $data = [
                'title' => 'Espace Entreprise',
                'style' => [
                    'header.css',
                    'footer.css',
                    'homeEntreprise.css',
                ],
                'script' => [
                    'script.js'
                ],
                'projets' => $projets,
                'alternances' => $alternances,
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
                    'header.css',
                    'footer.css',
                    'homeEtudiant.css',
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
                    'header.css',
                    'footer.css',
                    'homeEnseignant.css',
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
            isset($_SESSION['level']) && $_SESSION['level'] == 'administrateur'
        ) {

            // Charger les données nécessaires pour la vue
            $data = [
                'title' => 'Espace Administrateur',
                'style' => [
                    'header.css',
                    'footer.css',
                    'homeAdmin.css'
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
            header('Location: ' . URL .'/connexion');
            exit;
        }

        
    }
}
