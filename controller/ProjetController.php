<?php
class ProjetController {
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

            header('Location: projet/list');
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
    public function consulter() {
        $sqlModel = new SqlModel();
        // Récupérer les données des projets depuis la base de données
        $projets = $sqlModel->getTableData('projets');

        // Afficher les données des projets
        foreach ($projets as $projet) {
            echo 'ID : ' . $projet['id'] . '<br>';
            echo 'Nom : ' . $projet['nom'] . '<br>';
            echo 'Description : ' . $projet['description'] . '<br>';
            echo '------------------------<br>';
        }
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
