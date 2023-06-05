<?php

require_once 'model\SqlModel.php';

class ProjetsController {
    public function index() {

        session_start();

        // Entreprise ou Admin
        if (
            (
                isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true &&
                isset($_SESSION['level']) && $_SESSION['level'] == 'entreprise'
            ) || (
                isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true &&
                isset($_SESSION['level']) && $_SESSION['level'] == 'admin'
            )
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
            require 'view/projets.php';

            // Inclure le fichier de pied de page
            require 'view/footer.php';
        } 

        // Etudiant ou Enseignant
        elseif (
            (
                isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true &&
                isset($_SESSION['level']) && $_SESSION['level'] == 'etudiant'
            ) || (
                isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true &&
                isset($_SESSION['level']) && $_SESSION['level'] == 'enseignant'
            )
        ) {

            header('Location: projets/list');
        } 
        
        else {
            // L'utilisateur n'est pas connecté, redirigez-le vers la page de connexion
            header('Location: connexion');
            exit;
        }
        
    }
    public function list() {
        $sqlModel = new SqlModel();
        // Récupérer les données des projets depuis la base de données
        $projets = $sqlModel->getTableData('projets');
    
        $proj = [];
    
        foreach ($projets as $projet) {
            $proj[] = [
                'titre' => $projet['titre'],
                'description' => $projet['description']
            ];
        }

        var_dump($proj);
    
        // Inclure le fichier d'en-tête
        require 'view/header.php';
        
        // Afficher la vue avec les données
        require 'view/projetsList.php';
    
        // Inclure le fichier de pied de page
        require 'view/footer.php';
    }
    

    public function modifier($id) {
        // Vérifier si un formulaire de modification a été soumis
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nom = $_POST['nom'];
            $description = $_POST['description'];

            // Effectuer les opérations de mise à jour dans la base de données
            // ...
            echo "Projet $id modifié avec succès.";
        } else {
            // Afficher le formulaire de modification
            echo "Formulaire de modification du projet $id";
            // ...
        }
    }

    public function ajouter() {
        // Vérifier si un formulaire d'ajout a été soumis
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nom = $_POST['nom'];
            $description = $_POST['description'];

            // Effectuer les opérations d'ajout dans la base de données
            // ...
            echo "Projet ajouté avec succès.";
        } else {
            // Afficher le formulaire d'ajout
            echo "Formulaire d'ajout de projet";
            // ...
        }
    }
}
