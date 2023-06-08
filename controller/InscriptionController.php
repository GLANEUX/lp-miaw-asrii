<?php

require_once 'model\SqlModel.php';


class InscriptionController {
    public function index() {
        session_start();
        if (isset($_SESSION['is_logged_in'])) {
            header('Location: ' . URL .'/home');
            exit;
        } elseif (isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password'])) {

            $sqlModel = new SqlModel();

            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

            $inscription = $sqlModel->addEntrepriseRequest('\'' . $_POST['nom'] . '\', \''  . $_POST['prenom'] . '\', \'' . $_POST['email'] . '\',\'' . $_POST['username'] . '\', \'' . $password . '\'');
        
            header('Location: ' . URL .'/home');
            exit;

        } else {

            // Charger les données nécessaires pour la vue
            $data = [
                'title' => 'Formulaire d\'inscription',
                'style' => [
                    'header.css',
                    'footer.css',
                    'connexion.css',
                ],
                'script' => [
                    'script.js'
                ]
            ];

            // Inclure le fichier d'en-tête
            require 'view/header.php';

            // Afficher la vue avec les données
            require 'view/inscription.php';

            // Inclure le fichier de pied de page
            require 'view/footer.php';

        }
    }
}
?>


