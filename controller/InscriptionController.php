<?php

require_once 'model\SqlModel.php';


class InscriptionController {
    public function index() {
        session_start();
        if (isset($_SESSION['is_logged_in'])) {
            header('Location: ' . URL .'/home');
            exit;
        } elseif (
            isset($_POST['societe']) && 
            isset($_POST['siret']) &&
            isset($_POST['adresse']) && 
            isset($_POST['code_postal'])&& 
            isset($_POST['ville']) && 
            isset($_POST['username']) && 
            isset($_POST['numero']) && 
            isset($_POST['email']) && 
            isset($_POST['password'])
        ) {

            if ($_POST['complement'] != '') { $complement = '\'' . $_POST['complement'] . '\''; } else { $complement = 'NULL'; }

            $sqlModel = new SqlModel();

            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

            $query = $sqlModel->SqlRequest("INSERT INTO adresses (adresse, complement, code_postal, ville) VALUES ('$_POST[adresse]', $complement, '$_POST[code_postal]', '$_POST[ville]')");
            $query = $sqlModel->SqlRequest("SELECT id FROM adresses WHERE adresse = '$_POST[adresse]' AND code_postal = '$_POST[code_postal]' AND ville = '$_POST[ville]'");
            while ($row = $query->fetch_assoc()) {
                $adresse_id[] = $row;
            }
            $adresse_id = $adresse_id[0]['id'];
            $query = $sqlModel->SqlRequest("INSERT INTO entreprises (societe, siret, adresse_id, numero, email, username, password) VALUES ('$_POST[societe]', '$_POST[siret]', $adresse_id, '$_POST[numero]', '$_POST[email]', '$_POST[username]', '$password')");
        
            header('Location: ' . URL .'/home');
            exit;

        } else {

            // Charger les données nécessaires pour la vue
            $data = [
                'title' => 'Formulaire d\'inscription',
                'style' => [
                    'header.css',
                    'footer.css',
                    'inscription.css',
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


